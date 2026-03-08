<div>
  <form wire:submit.prevent="calculate" class="row">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
       <div class="lg:w-[80%] w-full mx-auto ">
                @if(isset($error))
                    <p class="text-red-600 text-lg font-bold">{{ $error }}</p>
                @endif
                <div class="grid md:grid-cols-2 grid-cols-1  gap-2 mt-4">
                    <div class="px-2 lg:pe-4 mt-0 lg:mt-2">
                        <label for="salary" class="label">{{ $lang['salary_amount'] }}:</label>
                        <div class="relative py-2 w-full">
                            <input type="number" step="any" class="input w-full py-2 px-3 border border-gray-300 rounded-lg" wire:model="salary" id="salary" name="salary" placeholder="$ 00">
                            <span class="absolute right-3 top-1/2 transform -translate-y-1/2 ">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="px-2 lg:ps-4 mt-0 lg:mt-2">
                        <label for="per" class="label">{{ $lang['per'] }}:</label>
                        <div class="py-2 w-full">
                            <select name="per" id="per" wire:model="per" class="input w-full py-2 px-3 border border-gray-300 rounded-lg">
                                <option value="Hourly">Hourly</option>
                                <option value="Daily">Daily</option>
                                <option value="Weekly">Weekly</option>
                                <option value="Bi-Weekly">Bi-Weekly</option>
                                <option value="Semi-Monthly">Semi-Monthly</option>
                                <option value="Monthly">Monthly</option>
                                <option value="Quarterly">Quarterly</option>
                                <option value="Annual">Annual</option>
                            </select>
                        </div>
                    </div>
                    <div class="px-2 lg:pe-4 mt-0 lg:mt-2">
                        <label for="hours" class="label">{{ $lang['hours_per'] }}:</label>
                        <div class="py-2 w-full">
                            <input type="number" step="any" class="input w-full py-2 px-3 border border-gray-300 rounded-lg" id="hours" wire:model="hours" name="hours" placeholder="e.g. 40">
                        </div>
                    </div>
                    <div class="px-2 lg:ps-4 mt-0 lg:mt-2">
                        <label for="days" class="label">{{ $lang['days_per'] }}:</label>
                        <div class="py-2 w-full">
                            <select name="days" id="days" wire:model="days" class="input w-full py-2 px-3 border border-gray-300 rounded-lg">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                            </select>
                        </div>
                    </div>
                    <div class="px-2 lg:pe-4 mt-0 lg:mt-2">
                        <label for="holidays" class="label">{{ $lang['holidays_per'] }}:</label>
                        <div class="py-2 w-full">
                            <input type="number" class="input w-full py-2 px-3 border border-gray-300 rounded-lg" id="holidays" wire:model="holidays" name="holidays" placeholder="e.g. 12">
                        </div>
                    </div>
                    <div class="px-2 lg:ps-4 mt-0 lg:mt-2">
                        <label for="vacation" class="label">{{ $lang['vacation_days'] }}:</label>
                        <div class="py-2 w-full">
                            <input type="number" class="input w-full py-2 px-3 border border-gray-300 rounded-lg" id="vacation" wire:model="vacation" name="vacation" placeholder="e.g. 12">
                        </div>
                    </div>
                </div>
                <div class="w-full mx-auto overflow-hidden">
                    <p class="py-2 mx-2">Income Taxes (Optional)</p>
                </div>
                <div class="grid md:grid-cols-2 grid-cols-1 gap-2 mt-4">
                    <div class="px-2 lg:pe-4 mt-0 lg:mt-2">
                        <label for="are" class="label">Salary Amount are:</label>
                        <div class="py-2 w-full">
                            <select name="are" id="are" wire:model="are" class="input w-full py-2 px-3 border border-gray-300 rounded-lg">
                                <option value="1">Before Tax</option>
                                <option value="2">After Tax</option>
                            </select>
                        </div>
                    </div>
                    <div class="px-2 lg:ps-4 mt-0 lg:mt-2">
                        <label for="tax" class="label">Income Tax (%)</label>
                        <div class="py-2 w-full">
                            <input type="number" step="any" class="input w-full py-2 px-3 border border-gray-300 rounded-lg" id="tax" wire:model="tax" name="tax" placeholder="e.g. 16.5">
                        </div>
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

    @isset($detail)
    {{-- result --}}
  <hr style="height: 1px; background-color: #e5e7eb;">
           <div id="result-section" wire:loading.remove wire:target="calculate"
                 class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg md:p-4 lg:p-4 flex items-center justify-center">
                <div class="w-full col-12  lg:p-3 md:p-3 rounded-lg mt-3">
                    <div class="col font-s-14">
                        @if($are == '2' && !empty($tax))
                        
                        <div class="col">
                            <p class="col-span-12 mt-3 font-bold text-xl text-gray-900"><strong>Before Tax</strong></p>
                            <!-- Responsive Table Wrapper -->
                            <div class="overflow-x-auto">
                                <table class="min-w-full  rounded-lg ">
                                    <!-- Table Head -->
                                    <thead>
                                        <tr class="bg-[#2845F5] text-white">
                                            <th rowspan="2" class="py-4 px-6 text-left font-semibold border-b border-gray-200">
                                                <strong>Periodicity</strong>
                                            </th>
                                            <th colspan="2" class="py-4 px-6 text-left font-semibold border-b border-gray-200">
                                                <strong>Holidays & Vacation Days</strong>
                                            </th>
                                        </tr>
                                        <tr class="bg-[#2845F5] text-white">
                                            <th class="py-3 px-6 text-left font-semibold border-b border-gray-200">
                                                <strong>{{ $lang['unadjust'] }}</strong>
                                            </th>
                                            <th class="py-3 px-6 text-left font-semibold border-b border-gray-200">
                                                <strong>Adjusted</strong>
                                            </th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['hourly'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">${{ number_format($detail['Hourly']/$detail['tax'], 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">${{ number_format($detail['a_Hourly']/$detail['tax'], 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['daily'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">${{ number_format($detail['Daily']/$detail['tax'], 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">${{ number_format($detail['a_Daily']/$detail['tax'], 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['weekly'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">${{ number_format($detail['Week']/$detail['tax'], 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">${{ number_format($detail['a_Week']/$detail['tax'], 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['bi_weekly'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">${{ number_format($detail['Bi_week']/$detail['tax'], 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">${{ number_format($detail['a_Bi_week']/$detail['tax'], 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['sami_monthly'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">${{ number_format($detail['Sami_month']/$detail['tax'], 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">${{ number_format($detail['a_Sami_month']/$detail['tax'], 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['monthly'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">${{ number_format($detail['Monthly']/$detail['tax'], 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">${{ number_format($detail['a_Monthly']/$detail['tax'], 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['quat'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">${{ number_format($detail['Quarterly']/$detail['tax'], 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">${{ number_format($detail['a_Quarterly']/$detail['tax'], 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['annual'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">${{ number_format($detail['Yearly']/$detail['tax'], 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">${{ number_format($detail['a_Yearly']/$detail['tax'], 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                        <div class="col">
                            <p class="col-span-12 mt-3 font-bold text-xl text-gray-900">
                                <strong>
                                    @if (!empty($tax))
                                        {{ $are == '1' ? "Before Tax" : "After Tax" }}
                                    @endif
                                </strong>
                            </p>
                            <!-- Responsive Table Wrapper -->
                            <div class="overflow-x-auto">
                                <table class="min-w-full b  rounded-lg ">
                                    <!-- Table Head -->
                                    <thead>
                                        <tr class="bg-[#2845F5] text-white">
                                            <th rowspan="2" class="py-4 px-6 text-left font-semibold border-b border-gray-200">
                                                <strong>Periodicity</strong>
                                            </th>
                                            <th colspan="2" class="py-4 px-6 text-left font-semibold border-b border-gray-200">
                                                <strong>Holidays & Vacation Days</strong>
                                            </th>
                                        </tr>
                                        <tr class="bg-[#2845F5]  text-white">
                                            <th class="py-3 px-6 text-left font-semibold border-b border-gray-200">
                                                <strong>{{ $lang['unadjust'] }}</strong>
                                            </th>
                                            <th class="py-3 px-6 text-left font-semibold border-b border-gray-200">
                                                <strong>Adjusted</strong>
                                            </th>
                                        </tr>
                                    </thead>
                        
                                    <!-- Table Body -->
                                    <tbody>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['hourly'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{$currancy }} {{ number_format($detail['Hourly'], 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{$currancy }} {{ number_format($detail['a_Hourly'], 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['daily'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{$currancy }} {{ number_format($detail['Daily'], 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{$currancy }} {{ number_format($detail['a_Daily'], 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['weekly'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{$currancy }} {{ number_format($detail['Week'], 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{$currancy }} {{ number_format($detail['a_Week'], 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['bi_weekly'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{$currancy }} {{ number_format($detail['Bi_week'], 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{$currancy }} {{ number_format($detail['a_Bi_week'], 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['sami_monthly'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{$currancy }} {{ number_format($detail['Sami_month'], 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{$currancy }} {{ number_format($detail['a_Sami_month'], 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['monthly'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{$currancy }} {{ number_format($detail['Monthly'], 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{$currancy }} {{ number_format($detail['a_Monthly'], 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['quat'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{$currancy }} {{ number_format($detail['Quarterly'], 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{$currancy }} {{ number_format($detail['a_Quarterly'], 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['annual'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{$currancy }} {{ number_format($detail['Yearly'], 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{$currancy }} {{ number_format($detail['a_Yearly'], 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        
                        
                        
                        @if($are == '1' && !empty($tax))
            
                        <div class="col mt-3">
                            <p class="text-lg font-bold mb-4">
                                <strong>After Tax</strong>
                            </p>
                            <div class="overflow-x-auto">
                                <table class="min-w-full  rounded-lg ">
                                    <thead class="bg-[#2845F5]  text-white">
                                        <tr>
                                            <th rowspan="2" class="py-4 px-6 text-left font-semibold border-b border-gray-200">Periodicity</th>
                                            <th colspan="2" class="py-4 px-6 text-left font-semibold border-b border-gray-200">Holidays & Vacation Days</th>
                                        </tr>
                                        <tr class="bg-[#2845F5]  text-white">
                                            <th class="py-3 px-6 text-left font-semibold border-b border-gray-200">{{ $lang['unadjust'] }}</th>
                                            <th class="py-3 px-6 text-left font-semibold border-b border-gray-200">Adjusted</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" divide-y divide-gray-200">
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['hourly'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $currancy }} {{ number_format($detail['Hourly'] - ($detail['Hourly'] * $detail['tax']), 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $currancy }} {{ number_format($detail['a_Hourly'] - ($detail['a_Hourly'] * $detail['tax']), 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['daily'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $currancy }} {{ number_format($detail['Daily'] - ($detail['Daily'] * $detail['tax']), 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $currancy }} {{ number_format($detail['a_Daily'] - ($detail['a_Daily'] * $detail['tax']), 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['weekly'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $currancy }} {{ number_format($detail['Week'] - ($detail['Week'] * $detail['tax']), 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $currancy }} {{ number_format($detail['a_Week'] - ($detail['a_Week'] * $detail['tax']), 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['bi_weekly'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $currancy }} {{ number_format($detail['Bi_week'] - ($detail['Bi_week'] * $detail['tax']), 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $currancy }} {{ number_format($detail['a_Bi_week'] - ($detail['a_Bi_week'] * $detail['tax']), 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['sami_monthly'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $currancy }} {{ number_format($detail['Sami_month'] - ($detail['Sami_month'] * $detail['tax']), 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $currancy }} {{ number_format($detail['a_Sami_month'] - ($detail['a_Sami_month'] * $detail['tax']), 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['monthly'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $currancy }} {{ number_format($detail['Monthly'] - ($detail['Monthly'] * $detail['tax']), 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $currancy }} {{ number_format($detail['a_Monthly'] - ($detail['a_Monthly'] * $detail['tax']), 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['quat'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $currancy }} {{ number_format($detail['Quarterly'] - ($detail['Quarterly'] * $detail['tax']), 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $currancy }} {{ number_format($detail['a_Quarterly'] - ($detail['a_Quarterly'] * $detail['tax']), 2) }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $lang['annual'] }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $currancy }} {{ number_format($detail['Yearly'] - ($detail['Yearly'] * $detail['tax']), 2) }}</td>
                                            <td class="py-4 px-6 border-b text-gray-700">{{ $currancy }} {{ number_format($detail['a_Yearly'] - ($detail['a_Yearly'] * $detail['tax']), 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                     @endif
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
</div>
