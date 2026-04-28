<div>
    <style>
        .fractionUpDown {
            display: inline-flex;
            flex-direction: column;
            vertical-align: middle;
            text-align: center;
            line-height: 1;
            margin: 0 4px;
        }
        .fractionUpDown .num {
            border-bottom: 1px solid currentColor;
            padding: 0 2px 2px;
        }
        .fractionUpDown .den {
            padding: 2px 2px 0;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-4">
                    {{-- Find --}}
                    <div class="col-span-12">
                        <label for="find" class="label">{{ $lang['18'] ?? 'Find' }}</label>
                        <select wire:model.live="find" id="find" class="input">
                            <option value="0">{{ $lang['1'] ?? 'Linear Relation' }}</option>
                            <option value="1">{{ $lang['2'] ?? 'Time/Velocity Relation' }}</option>
                            <option value="2">{{ $lang['3'] ?? 'Torque/Moment Relation' }}</option>
                        </select>
                    </div>

                    {{-- Mode 0: Linear Relation --}}
                    @if ($find == '0')
                        <div class="col-span-12">
                            <p class="font-bold mb-2">{{ $lang['4'] ?? 'Given' }}:</p>
                            <div class="flex flex-wrap gap-4">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" wire:model.live="select1" value="angular_acceleration" class="w-4 h-4 text-blue-600">
                                    <span>{{ $lang['5'] ?? 'Angular Acceleration' }}</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" wire:model.live="select1" value="radius" class="w-4 h-4 text-blue-600">
                                    <span>{{ $lang['6'] ?? 'Radius' }}</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" wire:model.live="select1" value="tangential_acceleration" class="w-4 h-4 text-blue-600">
                                    <span>{{ $lang['7'] ?? 'Tangential Acceleration' }}</span>
                                </label>
                            </div>
                        </div>

                        @if ($select1 != 'tangential_acceleration')
                            <div class="col-span-12 md:col-span-6">
                                <label for="ta" class="label">{{ $lang['7'] ?? 'Tangential Acceleration' }} (a)</label>
                                <div class="relative">
                                    <input type="number" step="any" wire:model.live="ta" id="ta" class="input" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('ta_unit')">
                                        {{ $ta_unit }} ▾
                                    </label>
                                    @if ($openDropdown === 'ta_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto">
                                            @foreach (['m/s²', 'g'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('ta_unit', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if ($select1 != 'radius')
                            <div class="col-span-12 md:col-span-6">
                                <label for="ra" class="label">{{ $lang['6'] ?? 'Radius' }} (R)</label>
                                <div class="relative">
                                    <input type="number" step="any" wire:model.live="ra" id="ra" class="input" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('ra_unit')">
                                        {{ $ra_unit }} ▾
                                    </label>
                                    @if ($openDropdown === 'ra_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto">
                                            @foreach (['mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('ra_unit', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if ($select1 != 'angular_acceleration')
                            <div class="col-span-12 md:col-span-6">
                                <label for="aa" class="label">{{ $lang['5'] ?? 'Angular Acceleration' }} (α)</label>
                                <div class="relative">
                                    <input type="number" step="any" wire:model.live="aa" id="aa" class="input" />
                                    <span class="absolute right-6 top-4 text-gray-500">rad/s²</span>
                                </div>
                            </div>
                        @endif
                    @endif

                    {{-- Mode 1: Time/Velocity Relation --}}
                    @if ($find == '1')
                        <div class="col-span-12">
                            <p class="font-bold mb-2">{{ $lang['4'] ?? 'Given' }}:</p>
                            <div class="flex flex-wrap gap-4">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" wire:model.live="select3" value="angular_acceleration_three" class="w-4 h-4 text-blue-600">
                                    <span>{{ $lang['5'] ?? 'Angular Acceleration' }}</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" wire:model.live="select3" value="time" class="w-4 h-4 text-blue-600">
                                    <span>{{ $lang['10'] ?? 'Time' }}</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" wire:model.live="select3" value="inv" class="w-4 h-4 text-blue-600">
                                    <span>{{ $lang['11'] ?? 'Initial Angular Velocity' }}</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" wire:model.live="select3" value="fnv" class="w-4 h-4 text-blue-600">
                                    <span>{{ $lang['12'] ?? 'Final Angular Velocity' }}</span>
                                </label>
                            </div>
                        </div>

                        @if ($select3 != 'angular_acceleration_three')
                            <div class="col-span-12 md:col-span-6">
                                <label for="aa" class="label">{{ $lang['5'] ?? 'Angular Acceleration' }} (α)</label>
                                <div class="relative">
                                    <input type="number" step="any" wire:model.live="aa" id="aa" class="input" />
                                    <span class="absolute right-6 top-4 text-gray-500">rad/s²</span>
                                </div>
                            </div>
                        @endif

                        @if ($select3 != 'time')
                            <div class="col-span-12 md:col-span-6">
                                <label for="time" class="label">{{ $lang['10'] ?? 'Time' }} (t)</label>
                                <div class="relative">
                                    <input type="number" step="any" wire:model.live="time" id="time" class="input" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('time_unit')">
                                        {{ $time_unit }} ▾
                                    </label>
                                    @if ($openDropdown === 'time_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto">
                                            @foreach (['sec', 'min', 'hrs', 'days', 'wks', 'mos', 'yrs'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('time_unit', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if ($select3 != 'inv')
                            <div class="col-span-12 md:col-span-6">
                                <label for="inv" class="label">{{ $lang['11'] ?? 'Initial Angular Velocity' }} (ω₁)</label>
                                <div class="relative">
                                    <input type="number" step="any" wire:model.live="inv" id="inv" class="input" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('inv_unit')">
                                        {{ $inv_unit }} ▾
                                    </label>
                                    @if ($openDropdown === 'inv_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto">
                                            @foreach (['rad/s', 'rpm', 'Hz'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('inv_unit', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if ($select3 != 'fnv')
                            <div class="col-span-12 md:col-span-6">
                                <label for="fnv" class="label">{{ $lang['12'] ?? 'Final Angular Velocity' }} (ω₂)</label>
                                <div class="relative">
                                    <input type="number" step="any" wire:model.live="fnv" id="fnv" class="input" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('fnv_unit')">
                                        {{ $fnv_unit }} ▾
                                    </label>
                                    @if ($openDropdown === 'fnv_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto">
                                            @foreach (['rad/s', 'rpm', 'Hz'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('fnv_unit', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endif

                    {{-- Mode 2: Torque/Moment Relation --}}
                    @if ($find == '2')
                        <div class="col-span-12">
                            <p class="font-bold mb-2">{{ $lang['4'] ?? 'Given' }}:</p>
                            <div class="flex flex-wrap gap-4">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" wire:model.live="select2" value="angular_acceleration_two" class="w-4 h-4 text-blue-600">
                                    <span>{{ $lang['5'] ?? 'Angular Acceleration' }}</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" wire:model.live="select2" value="mass" class="w-4 h-4 text-blue-600">
                                    <span>{{ $lang['8'] ?? 'Moment of Inertia' }}</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" wire:model.live="select2" value="total_torque_two" class="w-4 h-4 text-blue-600">
                                    <span>{{ $lang['9'] ?? 'Total Torque' }}</span>
                                </label>
                            </div>
                        </div>

                        @if ($select2 != 'angular_acceleration_two')
                            <div class="col-span-12 md:col-span-6">
                                <label for="aa" class="label">{{ $lang['5'] ?? 'Angular Acceleration' }} (α)</label>
                                <div class="relative">
                                    <input type="number" step="any" wire:model.live="aa" id="aa" class="input" />
                                    <span class="absolute right-6 top-4 text-gray-500">rad/s²</span>
                                </div>
                            </div>
                        @endif

                        @if ($select2 != 'total_torque_two')
                            <div class="col-span-12 md:col-span-6">
                                <label for="torque" class="label">{{ $lang['9'] ?? 'Total Torque' }} (τ)</label>
                                <div class="relative">
                                    <input type="number" step="any" wire:model.live="torque" id="torque" class="input" />
                                    <span class="absolute right-6 top-4 text-gray-500">N·m</span>
                                </div>
                            </div>
                        @endif

                        @if ($select2 != 'mass')
                            <div class="col-span-12 md:col-span-6">
                                <label for="moment" class="label">{{ $lang['8'] ?? 'Moment of Inertia' }} (I)</label>
                                <div class="relative">
                                    <input type="number" step="any" wire:model.live="moment" id="moment" class="input" />
                                    <span class="absolute right-6 top-4 text-gray-500">kg·m²</span>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @endif
        </div>
    </form>

    <hr>

    @if ($detail)
        <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 my-3">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full font-s-20 overflow-auto">
                            @if($detail['method']=="1")
                                <p class="mt-2"><strong>{{ $lang['5']}} (`\alpha`)</strong></p>
                                <p class="mt-2"><strong>{{ round($detail['ans'],2)}}<span> (rad/s<sup>2</sup>)</span></strong></p>
                                <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                                <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                                <p class="mt-2">`\alpha = \dfrac{a}{R}`</p> 
                                <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                                <p class="mt-2"><strong>`a = {{ $detail['first_value']; }}, R = {{ $detail['second_value']}},  \ and \  {{ $lang['16']}} \ \alpha `</strong></p>
                                <p class="mt-2"><strong>{{ $lang['17']}} :</strong></p>
                                <p class="mt-2">`\alpha = \dfrac{a}{R}`</p> 
                                <p class="mt-2">`\alpha = \dfrac{{{ $detail['first_value'] }}}{{{ $detail['second_value']; }}}`</p> 
                                <p class="mt-2 dk">`\alpha = {{ $detail['ans'] }}`</p>
                            @endif
                            @if($detail['method']=="2")
                                <p class="mt-2"><strong>{{ $lang['6']}} (R)</strong></p>
                                <p class="mt-2"><strong>{{ round($detail['ans'],2)}}<span> (m)</span></strong></p>
                                <p class="mt-2"><strong>{{ $lang['19']}}:</strong></p>
                                <div class="mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="color_blue">{{ $lang['6']}} (R)</td>
                                        <td class=""><strong>{{ $detail['ans']*1000}} (mm)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="color_blue">{{ $lang['6']}} (R)</td>
                                        <td class=""><strong>{{ $detail['ans']*100}} (cm)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="color_blue">{{ $lang['6']}} (R)</td>
                                        <td class=""><strong>{{ $detail['ans']*0.001}} (km)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="color_blue">{{ $lang['6']}} (R)</td>
                                        <td class=""><strong>{{ $detail['ans']*39.37}} (in)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="color_blue">{{ $lang['6']}} (R)</td>
                                        <td class=""><strong>{{ $detail['ans']*3.281}} (ft)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="color_blue">{{ $lang['6']}} (R)</td>
                                        <td class=""><strong>{{ $detail['ans']*1.0936}} (yd)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="color_blue">{{ $lang['6']}} (R)</td>
                                        <td class=""><strong>{{ $detail['ans']*0.0006214}} (mi)</strong></td>
                                    </tr>
                                </table>
                                </div>
                                <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                                <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                                <p class="mt-2">`R = \dfrac{a}{\alpha}`</p> 
                                <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                                <p class="mt-2"><strong>`a = {{ $detail['second_value']; }}, \alpha = {{ $detail['first_value']}},  \ and \  {{ $lang['16']}} \ R `</strong></p>
                                <p class="mt-2"><strong>{{ $lang['17']}}:</strong></p>
                                <p class="mt-2">`R = \dfrac{{{ $detail['second_value'] }}}{{{ $detail['first_value']; }}}`</p>
                                <p class="mt-2 dk">`R = {{ $detail['ans'] }}`</p>
                            @endif
                            @if($detail['method']=="3")
                                <p class="mt-2"><strong>{{ $lang['7']}} (a)</strong></p>
                                <p class="mt-2"><strong>{{round($detail['ans'],2)}}<span> (m/s<sup>2</sup>)</span></strong></p>
                                <p class="mt-2"><strong>{{ $lang['19']}}:</strong></p>
                                <div class="mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="color_blue">{{ $lang['7']}} (a)</td>
                                        <td><strong>{{ $detail['ans']*0.10197}} (g)</strong></td>
                                    </tr>
                                </table>
                                </div>
                                <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                                <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                                <p class="mt-2">`a = \alpha*R`</p> 
                                <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                                <p class="mt-2"><strong>`\alpha = {{ $detail['first_value']; }}, R = {{ $detail['second_value']}},  \ and \  {{ $lang['16']}} \ R `</strong></p>
                                <p class="mt-2"><strong>{{ $lang['17']}}:</strong></p>
                                <p class="mt-2">`a = {{ $detail['first_value'] }}*{{ $detail['second_value'] }}`</p> 
                                <p class="mt-2 dk">`a = {{ $detail['ans'] }}`</p>
                            @endif
                            @if($detail['method']=="4")
                                <p class="mt-2"><strong>{{ $lang['5']}} (`\alpha`)</strong></p>
                                <p class="mt-2"><strong>{{ round($detail['ans'],2)}}<span> (rad/s<sup>2</sup>)</span></strong></p>
                                <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                                <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                                <p class="mt-2">`\alpha = \dfrac{ω₂ - ω₁}{t}`</p> 
                                    <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                                <p class="mt-2"><strong>`ω₁ = {{ $detail['first_value']; }},ω₂ = {{ $detail['second_value']}},t = {{ $detail['third_value'] }}  \ and \  {{ $lang['16']}} \ \alpha `</strong></p>
                                <p class="mt-2"><strong>{{ $lang['17']}} :</strong></p>
                                <p class="mt-2">`\alpha = \dfrac{ω₂ - ω₁}{t}`</p>
                                <p class="mt-2">`\alpha = \dfrac{ {{ $detail['second_value'] }} - {{ $detail['first_value'] }}}{{{ $detail['third_value'] }}}`</p>
                                <p class="mt-2 dk">`\alpha = {{ $detail['ans'] }}`</p>
                            @endif
                            @if($detail['method']=="5")
                                <p class="mt-2"><strong>{{ $lang['10']}} (t)</strong></p>
                                <p class="mt-2"><strong>{{ round($detail['ans'],2)}}<span> (sec) </span></strong></p>
                                <p class="mt-2"><strong>{{ $lang['19']}}:</strong></p>
                                <div class="mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="color_blue">{{ $lang['10']}} (t)</td>
                                        <td class=""><strong>{{ $detail['ans']*0.016667}} minutes (min)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="color_blue">{{ $lang['10']}} (t)</td>
                                        <td class=""><strong>{{ $detail['ans']*0.0002778}} hour (hrs)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="color_blue">{{ $lang['10']}} (t)</td>
                                        <td class=""><strong>{{ $detail['ans']*0.000011574}} days(days)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="color_blue">{{ $lang['10']}} (t)</td>
                                        <td class=""><strong>{{ $detail['ans']*0.0000016534}} weeks(wks)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="color_blue">{{ $lang['10']}} (t)</td>
                                        <td class=""><strong>{{ $detail['ans']*0.00000038026}} months(mos)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="color_blue">{{ $lang['10']}} (t)</td>
                                        <td class=""><strong>{{ $detail['ans']*0.00000003169}} years(yrs)</strong></td>
                                    </tr>
                                </table>
                                </div>
                                <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                                <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                                <p class="mt-2">`t = \dfrac{ω₂ - ω₁}{a}`</p> 
                                    <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                                <p class="mt-2"><strong>`ω₁ = {{ $detail['first_value']; }},ω₂ = {{ $detail['second_value']}},a = {{ $detail['third_value'] }}  \ and \  {{ $lang['16']}} \ \alpha `</strong></p>
                                <p class="mt-2"><strong>{{ $lang['17']}} :</strong></p>
                                <p class="mt-2">`t = \dfrac{ω₂ - ω₁}{a}`</p>
                                <p class="mt-2">`t = \dfrac{ {{ $detail['second_value'] }} - {{ $detail['first_value'] }}}{{{ $detail['third_value'] }}}`</p>
                                <p class="mt-2 dk">`t = {{ $detail['ans'] }}`</p>
                            @endif
                            @if($detail['method']=="6")
                                <p class="mt-2"><strong>{{ $lang['11']}} (ω₁)</strong></p>
                                <p class="mt-2"><strong>{{ round($detail['ans'],2)}}<span> (rad/s) </span></strong></p>
                                <p class="mt-2"><strong>{{ $lang['19']}}:</strong></p>
                                <div class="mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="color_blue">{{ $lang['11']}} (ω₁)</td>
                                        <td class=""><strong>{{ round($detail['ans']*9.55,2)}} Rotations per minute (rpm)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="color_blue">{{ $lang['11']}} (ω₁)</td>
                                        <td class=""><strong>{{ round($detail['ans']*0.15915,2)}} Hertz (Hz)</strong></td>
                                    </tr>
                                </table>
                                </div>
                                <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                                <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                                <p class="mt-2">`ω₁ = ω₂-(t*\alpha)`</p> 
                                <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                                <p class="mt-2"><strong>`ω₂ = {{ $detail['first_value']; }},t = {{ $detail['second_value']}},\alpha = {{ $detail['third_value'] }}  \ and \  {{ $lang['16']}} \ ω₁ `</strong></p>
                                <p class="mt-2"><strong>{{ $lang['17']}} :</strong></p>
                                <p class="mt-2">`ω₁ = ω₂-(t*\alpha)`</p>
                                <p class="mt-2">`ω₁ = {{ $detail['first_value'] }}-({{ $detail['second_value'] }}*{{ $detail['third_value'] }})`</p>
                                <p class="mt-2 dk">`ω₁ = {{ $detail['ans'] }}`</p>
                            @endif
                            @if($detail['method']=="7")
                                <p class="mt-2"><strong>{{ $lang['12']}} (ω₂)</strong></p>
                                <p class="mt-2"><strong>{{ round($detail['ans'],2)}}<span> (rad/s) </span></strong></p>
                                <p class="mt-2"><strong>{{ $lang['19']}}:</strong></p>
                                <div class="mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="color_blue">{{ $lang['12']}} (ω₂)</td>
                                        <td class=""><strong>{{ round($detail['ans']*9.55,2)}} Rotations per minute (rpm)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="color_blue">{{ $lang['12']}} (ω₂)</td>
                                        <td class=""><strong>{{ round($detail['ans']*0.15915,2)}} Hertz (Hz)</strong></td>
                                    </tr>
                                </table>
                                </div>
                                <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                                <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                                <p class="mt-2">`ω₂ =(t*\alpha)+ω₁`</p> 
                                <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                                <p class="mt-2"><strong>`ω₁ = {{ $detail['first_value']; }},t = {{ $detail['second_value']}},\alpha = {{ $detail['third_value'] }}  \ and \  {{ $lang['16']}} \ ω₂ `</strong></p>
                                <p class="mt-2"><strong>{{ $lang['17']}} :</strong></p>
                                <p class="mt-2">`ω₂ =(t*\alpha)+ω₁`</p>
                                <p class="mt-2">`ω₂ =({{ $detail['second_value'] }}*{{ $detail['third_value'] }} )+{{ $detail['first_value'] }}`</p>
                                <p class="mt-2 dk">`ω₂ = {{ $detail['ans'] }}`</p>
                            @endif
                            @if($detail['method']=="8")
                                <p class="mt-2"><strong>{{ $lang['5']}} (`\alpha`)</strong></p>
                                <p class="mt-2"><strong>{{ round($detail['ans'],2)}}<span> (rad/s<sup>2</sup>)</span></strong></p>
                                <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                                <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                                <p class="mt-2">`\alpha = \dfrac{τ}{I}`</p> 
                                <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                                <p class="mt-2"><strong>`τ = {{ $detail['first_value']; }}, I = {{ $detail['second_value']}},  \ and \  {{ $lang['16']}} \ \alpha `</strong></p>
                                <p class="mt-2"><strong>{{ $lang['17']}} :</strong></p>
                                <p class="mt-2">`\alpha = \dfrac{τ}{I}`</p>
                                <p class="mt-2">`\alpha = \dfrac{{{ $detail['first_value'] }}}{{{ $detail['second_value'] }}}`</p>
                                <p class="mt-2 dk">`\alpha = {{ $detail['ans'] }}`</p>
                            @endif
                            @if($detail['method']=="9")
                                <p class="mt-2"><strong>{{ $lang['8']}} (`I`)</strong></p>
                                <p class="mt-2"><strong>{{ round($detail['ans'],2)}}<span> (kg-m<sup>2</sup>/rad<sup>2</sup>)</span></strong></p>
                                <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                                <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                                <p class="mt-2">`I = \dfrac{τ}{\alpha}`</p> 
                                <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                                <p class="mt-2"><strong>`τ = {{ $detail['first_value']; }}, \alpha = {{ $detail['second_value']}},  \ and \  {{ $lang['16']}} \ I `</strong></p>
                                <p class="mt-2"><strong>{{ $lang['17']}} :</strong></p>
                                <p class="mt-2">`I = \dfrac{τ}{\alpha}`</p>
                                <p class="mt-2">`I = \dfrac{{{ $detail['first_value'] }}}{{{ $detail['second_value'] }}}`</p>
                                <p class="mt-2 dk">`I = {{ $detail['ans'] }}`</p>
                            @endif
                            @if($detail['method']=="10")
                                <p class="mt-2"><strong>{{ $lang['9']}} (`τ`)</strong></p>
                                <p class="mt-2"><strong>{{ round($detail['ans'],2)}}<span> rad/sec</span></strong></p>
                                <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                                <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                                <p class="mt-2">`τ =I*\alpha`</p> 
                                <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                                <p class="mt-2"><strong>`I = {{ $detail['first_value']; }}, \alpha = {{ $detail['second_value']}},  \ and \  {{ $lang['16']}} \ τ `</strong></p>
                                <p class="mt-2"><strong>{{ $lang['17']}} :</strong></p>
                                <p class="mt-2">`τ =I*\alpha`</p>
                                <p class="mt-2">`τ ={{ $detail['first_value'] }}*{{ $detail['second_value'] }}`</p>
                                <p class="mt-2 dk">`τ = {{ $detail['ans'] }}`</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @push('calculatorJS')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML">
    </script>
    <script type="text/x-mathjax-config">
    MathJax.Hub.Register.StartupHook("AsciiMath Jax Config",function () {
          var AM = MathJax.InputJax.AsciiMath.AM;
          AM.symbols.push({
              input:'rightleftharpoons',
              tag:'mo',
              output:'\u21CC',
              tex:'rightleftharpoons',
              ttype:'d'
          });
      });
      MathJax.Hub.Config({
          jax: ["input/TeX", "input/AsciiMath", "output/CommonHTML"],
          extensions: ["tex2jax.js", "asciimath2jax.js"],
          TeX: {
              extensions: ["AMSmath.js", "AMSsymbols.js", "noErrors.js", "noUndefined.js"]
          },
          tex2jax: {
              inlineMath: [['`','`']]
          },
          asciimath2jax: {
              delimiters: [['#','#']]
          },
          CommonHTML: {
              linebreaks: {
                  automatic: true
              }
          },
          messageStyle: "none",
          MathMenu: {
              showLocale: false,
              showRenderer: false
          }
      });
    </script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('initKaTeX', () => {
                setTimeout(() => {
                    if (window.MathJax) {
                        MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                    }
                }, 100);
            });

            Livewire.hook('morph.updated', (el, component) => {
                if (window.MathJax) {
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                }
            });
        });
    </script>
    @endpush
</div>