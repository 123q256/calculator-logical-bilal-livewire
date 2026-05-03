<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <!-- Toggle Mode -->
                <div class="flex items-center bg-blue-100 border border-blue-500 rounded-lg p-1 mb-6">
                    <div wire:click="changeUnit('salary')" class="w-1/2 px-2 py-1">
                        <div class="bg-white px-3 py-2 text-center cursor-pointer rounded-md transition-all duration-300 {{ $unit_type == 'salary' ? 'tagsUnit' : 'hover:bg-blue-50' }}">
                            {{ $lang['1'] ?? 'Salary' }}
                        </div>
                    </div>
                    <div wire:click="changeUnit('hourly')" class="w-1/2 px-2 py-1">
                        <div class="bg-white px-3 py-2 text-center cursor-pointer rounded-md transition-all duration-300 {{ $unit_type == 'hourly' ? 'tagsUnit' : 'hover:bg-blue-50' }}">
                            {{ $lang['2'] ?? 'Hourly' }}
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-4">
                    <!-- Base Rate -->
                    <div class="col-span-12">
                        <label for="rate" class="label font-bold text-xs mb-1 ">
                            {{ $lang['3'] ?? 'Rate' }} 
                            <span class="text-blue-600">{{ $unit_type == 'hourly' ? ($lang['4'] ?? 'Hourly') : ($lang['5'] ?? 'Annual') }}</span>
                        </label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="rate" id="rate" class="input" min="0" />
                            <span class="input_unit text-blue-600">{{ $currancy }}</span>
                        </div>
                        <p class="text-[10px] text-black mt-1 italic">
                            Note: {{ $unit_type == 'hourly' ? ($lang['8'] ?? 'Based on hours per month') : ($lang['9'] ?? 'Annual base salary') }}
                        </p>
                    </div>

                    <!-- Hours Worked -->
                    <div class="col-span-6">
                        <label for="hour_worked" class="label font-bold text-xs mb-1 text-black">{{ $lang['6'] ?? 'Hours/Week' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="hour_worked" id="hour_worked" class="input" min="0" />
                        </div>
                    </div>

                    <div class="col-span-6">
                        <label for="month" class="label font-bold text-xs mb-1 text-black">{{ $lang['7'] ?? 'Months/Year' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="month" id="month" class="input" min="0" />
                        </div>
                    </div>

                    <!-- Contributions Header -->
                    <div class="col-span-12 border-b pb-2 mt-4">
                        <h4 class="font-bold text-xs text-gray-600">{{ $lang['10'] ?? 'Annual Employer Contributions' }}</h4>
                    </div>

                    <!-- Standard Contributions -->
                    <div class="col-span-6">
                        <label for="benefits" class="label font-bold text-[10px] mb-1 ">{{ $lang['11'] ?? 'Benefits' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="benefits" id="benefits" class="input" min="0" />
                            <span class="input_unit text-[10px]">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="health" class="label font-bold text-[10px] mb-1 ">{{ $lang['12'] ?? 'Health' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="health" id="health" class="input" min="0" />
                            <span class="input_unit text-[10px]">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="dental" class="label font-bold text-[10px] mb-1 ">{{ $lang['13'] ?? 'Dental' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="dental" id="dental" class="input" min="0" />
                            <span class="input_unit text-[10px]">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="vision" class="label font-bold text-[10px] mb-1 ">{{ $lang['14'] ?? 'Vision' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="vision" id="vision" class="input" min="0" />
                            <span class="input_unit text-[10px]">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Dynamic Perks -->
                    <div class="col-span-12 space-y-3 mt-4">
                        @foreach ($perks as $index => $perk)
                            <div class="grid grid-cols-12 gap-4 items-end bg-gray-50 p-4 rounded-xl relative border border-gray-100">
                                <div class="col-span-6">
                                    <label class="label font-bold text-[10px] mb-1 ">Perk Name:</label>
                                    <input type="text" wire:model.live="perks.{{ $index }}.name" class="input !bg-white" placeholder="e.g. Gym" />
                                </div>
                                <div class="col-span-5">
                                    <label class="label font-bold text-[10px] mb-1 ">Annual Contribution:</label>
                                    <div class="relative">
                                        <input type="number" step="any" wire:model.live="perks.{{ $index }}.contribution" class="input !bg-white" />
                                        <span class="input_unit text-[10px]">{{ $currancy }}</span>
                                    </div>
                                </div>
                                <div class="col-span-1 flex justify-center">
                                    <button type="button" wire:click="removePerk({{ $index }})" class="p-2 hover:bg-red-50 rounded-full transition-colors group">
                                        <svg class="w-5 h-5 text-red-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-span-12 text-end pt-2">
                        <button type="button" wire:click="addPerk" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-[#2845F5] hover:bg-blue-700 rounded-lg transition-colors tracking-widest shadow-sm">
                            <span class="mr-2 text-lg">+</span>{{ $lang['15'] ?? 'Add Perk' }}
                        </button>
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
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    @if ($detail['submit'] == 'hourly')
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-3">
                            <table class="w-full text-[18px]">
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[16] }} </strong></td>
                                    @if(!isset($detail['perk_array']))
                                        <td class="py-2 border-b">{{$currancy }} {{ round($detail['emp_h_r'],2) }}</td>
                                    @elseif(isset($detail['perk_array']))
                                        <td class="py-2 border-b">{{$currancy }} {{ round($detail['emp_h_r_p'],2) }}</td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-3">
                            <table class="w-full text-[18px]">
                                @if (!isset($detail['perk_array']))
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[17] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r'] / 2 ,2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[18] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r'] / 4 ,2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[19] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r'] / 12 ,2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[20] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r'] / 52 ,2) }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[21] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r'] / 365 ,2) }} </strong></td>
                                    </tr>
                                    @elseif(isset($detail['perk_array']))
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[17] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 2 ,2) }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[18] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 4 ,2) }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[19] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 12 ,2) }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[20] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 52 ,2) }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[21] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 365 ,2) }} </strong></td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-12 mt-2 font-s-14">
                            <div class="col">
                                <p class="mt-3">{{ $lang['23'] }}</p>
                                <p class="mt-2">{{$lang['24']}} = {{$lang['3']}} {{$lang['4']}} x 4.66484 x {{$lang['6']}} x {{$lang['7']}}
                                    @if ($detail['benefits'] != '')
                                        + {{$lang['11']}}
                                    @endif
                                    @if($detail['health'] != '')
                                        + {{$lang['12']}} 
                                    @endif
                                    @if($detail['dental'] != '')
                                        + {{$lang['13']}} 
                                    @endif
                                    @if($detail['vision'] != '')
                                        + {{$lang['14']}} 
                                    @endif
                                </p>
                                <p class="mt-2">
                                    {{ $lang['24']}} = {{ $detail['rate']}} x 4.66484 x {{ $detail['hour_worked']}} x {{ $detail['month']}}
                                    @if ($detail['benefits'] != '')
                                        +  {{ $detail['benefits']}}
                                    @endif
                                    @if ($detail['health'] != '')
                                        +  {{ $detail['health']}}
                                    @endif
                                    @if ($detail['dental'] != '')
                                        +  {{ $detail['dental'] }}
                                    @endif
                                    @if ($detail['vision'] != '')
                                        +  {{ $detail['vision']}}
                                    @endif
                                </p>
                                <p class="mt-2">{{$lang['24']}} = {{$currancy }} {{round($detail['emp_h_r'],2) }}</p>
                                 @if (!empty($detail['perk_array']))
                                    <p class="mt-2">{{ $lang['25'] ?? 'Additional Perks Included' }}. </p>
                                    <p class="mt-2">{{ $lang['24'] }} = {{ $lang['24'] }}
                                         + 
                                         @php
                                             $output = implode(' + ', $detail['perk_array']);
                                             echo $output;
                                         @endphp
                                    </p>
                                    <p class="mt-2">{{ $lang['24'] }} = {{ round($detail['emp_h_r'], 2) }}
                                         + 
                                         @php
                                             $output = implode(' + ', $detail['perk_val']);
                                             echo $output;
                                         @endphp
                                    </p>
                                    <p class="mt-2">{{ $lang['24'] }} = {{ $currancy }} {{ round($detail['emp_h_r_p'], 2) }}</p>
                               @endif
                            </div>
                        </div>
                    @endif
            
                    @if ($detail['submit'] == 'salary')
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-3">
                            <table class="w-full text-[18px]">
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[16] }} </strong></td>
                                    @if(!isset($detail['perk_array']))
                                        <td class="py-2 border-b">{{$currancy }} {{ round($detail['anual_salary'],2) }}</td>
                                    @elseif(isset($detail['perk_array']))
                                        <td class="py-2 border-b">{{$currancy }} {{ round($detail['emp_h_r_p'],2) }}</td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-3">
                            <table class="w-full text-[18px]">
                                @if (!isset($detail['perk_array']))
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[17] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['anual_salary'] / 2 ,2) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[18] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['anual_salary'] / 4 ,2) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[19] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['anual_salary'] / 12 ,2) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[20] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['anual_salary'] / 52 ,2) }} </strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[21] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['anual_salary'] / 365 ,2) }} </strong></td>
                                </tr>
                                @elseif(isset($detail['perk_array']))
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[17] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 2 ,2) }} </strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[18] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 4 ,2) }} </strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[19] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 12 ,2) }} </strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[20] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 52 ,2) }} </strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[21] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 365 ,2) }} </strong></td>
                                </tr>
                                @endif
                            </table>
                        </div>
            
                        <div class="col-12 mt-2 font-s-14">
                            <div class="col">
                                <p class="mt-2">{{ $lang['23']}}</p>
                                <p class="mt-2">{{ $lang['5']}} =  {{ $lang['3']}} {{ $lang['5']}}  x 0.0765 </p>
                                <p class="mt-2">{{ $lang['5']}}  = {{ $detail['rate']}}  x 0.0765 </p>
                                <p class="mt-2">{{ $lang['5']}} = {{$currancy }} {{ $detail['per_anum']}} </p>
                                <p class="mt-2">{{ $lang['24']}} = {{ $lang['3']}} {{ $lang['5']}} + {{ $lang['5']}} 
                                    @if ($detail['benefits'] != '')
                                        + {{ $lang['11']}} 
                                    @endif
                                    @if ($detail['health'] != '')
                                        + {{ $lang['12']}} 
                                    @endif
                                    @if ($detail['dental'] != '')
                                        + {{ $lang['13']}} 
                                    @endif
                                    @if ($detail['vision'] != '')
                                        + {{ $lang['14']}} 
                                    @endif
                                </p>
                                <p class="mt-2">{{ $lang['24']}}  = {{ $detail['rate']}} + {{ $detail['per_anum']}}
                                    @if ($detail['benefits'] != '')
                                        + {{ $detail['benefits']}}
                                    @endif
                                    @if ($detail['health'] != '')
                                        + {{ $detail['health']}}
                                    @endif
                                    @if ($detail['dental'] != '')
                                        + {{ $detail['dental']}} 
                                    @endif
                                    @if ($detail['vision'] != '')
                                        + {{ $detail['vision']}}
                                    @endif
                                </p>
                                <p class="mt-2">{{$lang['24']}} = {{$currancy }} {{ round($detail['anual_salary'],2) }}</p>
                                @if (!empty($detail['perk_array']))
                                    <p class="mt-2 color_blue">{{ $lang['25'] ?? 'Additional Perks Included' }}. </p>
                                    <p class="mt-2">{{ $lang['24'] }} = {{ $lang['24'] }} 
                                        + 
                                        @php
                                            $output = implode(' + ', $detail['perk_array']);
                                            echo $output;
                                        @endphp
                                    </p>
                                    <p class="mt-2">{{ $lang['24'] }} = {{ round($detail['anual_salary'], 2) }} 
                                         + 
                                         @php
                                             $output = implode(' + ', $detail['perk_val']);
                                             echo $output;
                                         @endphp
                                    </p>
                                    <p class="mt-2">{{ $lang['24'] }} = {{ $currancy }} {{ round($detail['emp_h_r_p'], 2) }}</p>
                                @endif
                            </div>
                        </div>
            
                    @endif
                </div>
            </div>
        </div>
            </div>
        @endisset
    </form>
</div>
