<div>
    <style>
        .bg-gradient {
            background: #2845F5;
            padding: 5px;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    <!-- Gender -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="gender" class="label">{{ $lang['gender'] }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="gender" id="gender" class="input">
                                <option value="Male">{{ $lang['male'] }}</option>
                                <option value="Female">{{ $lang['female'] }}</option>
                                <option value="pergnant">{{ $lang['pergnant'] }}</option>
                                <option value="child">{{ $lang['child'] }}</option>
                                <option value="lac">{{ $lang['lac'] }}</option>
                                <option value="obs_boy">Obese Boy (3-18 Years)</option>
                                <option value="obs_girl">Obese Girl (3-18 Years)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Age (Adults/Others) -->
                    @if($gender !== 'child')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="age" class="label">{{ $lang['age_year'] }}:</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" wire:model.live="age" id="age" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    <!-- Child Age (Months) -->
                    @if($gender === 'child')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="child_age" class="label">{{ $lang['age_m'] }}:</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" wire:model.live="child_age" id="child_age" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    <!-- Pregnancy Trimester -->
                    @if($gender === 'pergnant')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="trim" class="label">{{ $lang['trim'] }}:</label>
                            <div class="w-100 py-2 position-relative">
                                <select wire:model.live="trim" id="trim" class="input">
                                    <option value="1st">{{ $lang['1st'] }}</option>
                                    <option value="2nd">{{ $lang['2nd'] }}</option>
                                    <option value="3rd">{{ $lang['3rd'] }}</option>
                                </select>
                            </div>
                        </div>
                    @endif

                    <!-- Lactation Period -->
                    @if($gender === 'lac')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="period" class="label">{{ $lang['period'] }}:</label>
                            <div class="w-100 py-2 position-relative">
                                <select wire:model.live="period" id="period" class="input">
                                    <option value="1st6">{{ $lang['1st6'] }}</option>
                                    <option value="2nd6">{{ $lang['2nd6'] }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="lac" class="label">{{ $lang['lac'] }}:</label>
                            <div class="w-100 py-2 position-relative">
                                <select wire:model.live="lac" id="lac" class="input">
                                    <option value="1st">{{ $lang['1st'] }}</option>
                                    <option value="2nd6">{{ $lang['2nd6'] }}</option>
                                </select>
                            </div>
                        </div>
                    @endif

                    <!-- Height -->
                    @if($gender !== 'child')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label class="label">{{ $lang['height'] }} <span class="text-blue">({{ $unit_ft_in }})</span>:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                @if($unit_ft_in === 'ft/in')
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="number" step="any" wire:model.live="height_ft" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="ft" />
                                        <input type="number" step="any" wire:model.live="height_in" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="in" />
                                    </div>
                                @else
                                    <input type="number" wire:model.live="height_cm" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="cm" />
                                @endif

                                <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit_ft_in }} ▾</label>
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit_ft_in', 'ft/in');" @click="open = false">feet / inches (ft/in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit_ft_in', 'cm');" @click="open = false">centimeters (cm)</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Weight -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="weight" class="label">{{ $lang['weight'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="weight" id="weight" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit', 'lbs');" @click="open = false">pounds (lbs)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit', 'kg');" @click="open = false">kilograms (kg)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Activity -->
                    @if($gender !== 'child')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="activity" class="label">{{ $lang['activity'] }}:</label>
                            <div class="w-100 py-2 position-relative">
                                <select wire:model.live="activity" id="activity" class="input">
                                    <option value="Sedentary">{{ $lang['stand'] }}</option>
                                    <option value="Lightly Active">{{ $lang['light'] }}</option>
                                    <option value="Moderately Active">{{ $lang['mod'] }}</option>
                                    <option value="Very Active">{{ $lang['very'] }}</option>
                                </select>
                            </div>
                        </div>
                    @endif

                    <!-- Goal -->
                    @if($gender !== 'child' && $gender !== 'obs_girl' && $gender !== 'obs_boy')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="goal" class="label">{{ $lang['goal'] }}:</label>
                            <div class="w-100 py-2 position-relative">
                                <select wire:model.live="goal" id="goal" class="input">
                                    <option value="maintain">{{ $lang['maintain'] }}</option>
                                    <option value="lose">{{ $lang['lose'] }}</option>
                                    <option value="gain">{{ $lang['gain'] }}</option>
                                </select>
                            </div>
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

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            @if(!isset($detail['EER_child']))
                                <div class="w-full">
                                    <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                        <!-- Main EER/TEE Result -->
                                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                            <div class="bg-[#F6FAFC] border rounded-xl px-2 py-6" style="border: 1px solid #c1b8b899;">
                                                <p class="text-center font-bold text-gray-700">
                                                    {{ isset($detail['tee']) ? 'Total Energy Expenditure (TEE)' : $lang['eer'] }}
                                                </p>
                                                <div class="flex items-center justify-between bg-white rounded-xl p-4 mt-4 shadow-sm">
                                                    <div class="flex items-center">
                                                        <img src="{{ url('images/eer-icon.png') }}" width="50" height="50" alt="eer icon">
                                                        <p class="text-lg ms-3 font-bold text-blue-700">{{ isset($detail['tee']) ? 'Your TEE' : $lang['your'] }}</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="text-3xl font-bold text-blue-700">{{ isset($detail['tee']) ? $detail['tee'] : $detail['EER'] }}</div>
                                                        <div class="text-xs text-gray-500">{{ $lang['Calories/Day'] }}</div>
                                                    </div>
                                                </div>
                                                @if(isset($detail['ibw']))
                                                    <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                                                        <p class="text-xs font-semibold text-blue-800">Healthy Weight Range would be:</p>
                                                        <p class="text-xl font-bold text-blue-700">{{ $detail['ibw'] }}</p>
                                                    </div>
                                                @endif
                                                <p class="mt-4 text-xs text-gray-500 leading-relaxed">
                                                    {{ isset($detail['tee']) ? $lang['obese_c'] : $lang['adult'] }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Sub Results (BMR, BMI, RMR) -->
                                        <div class="col-span-12 md:col-span-6 lg:col-span-6 space-y-3">
                                            @foreach(['bmr' => 'BMR', 'BMI' => 'BMI', 'rmr' => 'RMR'] as $key => $title)
                                                <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-xl p-4 border-gray-200">
                                                    <div class="flex items-center">
                                                        <img src="{{ url('images/'.strtolower($title).'.png') }}" width="45" height="45">
                                                        <p class="text-lg ms-3 font-bold text-blue-700">{{ $title }}</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="text-2xl font-bold text-blue-700">{{ $detail[$key] ?: '00.0' }}</div>
                                                        <div class="text-xs text-gray-500">
                                                            @if($key === 'BMI')
                                                                @php
                                                                    $classes = ['under' => $lang['under'], 'health' => $lang['health'], 'over' => $lang['over'], 'obese' => $lang['obese'], 's_obese' => $lang['s_obese']];
                                                                    $bmi_class = $classes[$detail['class']] ?? $lang['class'];
                                                                @endphp
                                                                {{ $bmi_class }}
                                                            @else
                                                                {{ $lang['Calories/Day'] }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            @if(in_array($gender, ['Male', 'Female']))
                                                <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-xl p-4 border-gray-200">
                                                    <div class="flex items-center">
                                                        <img src="{{ url('images/healthy_bmi.png') }}" width="45" height="45">
                                                        <p class="text-lg ms-3 font-bold text-blue-700">Healthy BMI</p>
                                                    </div>
                                                    <div class="text-2xl font-bold text-blue-700">18.5 - 24.9</div>
                                                </div>
                                            @endif

                                            @if(isset($detail['bee']))
                                                <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-xl p-4 border-gray-200">
                                                    <div class="flex items-center">
                                                        <img src="{{ url('images/maintain.png') }}" width="45" height="45">
                                                        <p class="text-lg ms-3 font-bold text-blue-700">BEE</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="text-2xl font-bold text-blue-700">{{ $detail['bee'] ?: '00.0' }}</div>
                                                        <div class="text-xs text-gray-500">{{ $lang['Calories/Day'] }}</div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Activity Levels Table -->
                                        <div class="col-span-12 overflow-hidden  border border-gray-200 mt-4">
                                            <table class="w-full" cellspacing="0">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="text-start text-blue-700 py-3 px-2 uppercase text-xs font-bold">{{ $lang['level'] }}</th>
                                                        <th class="text-start text-blue-700 py-3 px-2 uppercase text-xs font-bold">{{ $lang['energy'] }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach([
                                                        ['key' => 's', 'label' => 'stand', 'class' => 'stand'],
                                                        ['key' => 'l', 'label' => 'light', 'class' => 'light'],
                                                        ['key' => 'm', 'label' => 'mod', 'class' => 'mod'],
                                                        ['key' => 'v', 'label' => 'very', 'class' => 'very']
                                                    ] as $lvl)
                                                        <tr class="{{ ($detail[$lvl['class']] ?? '') === 'bg-gradient text-white' ? 'bg-blue-600 text-white' : '' }}">
                                                            <td class="py-3 px-2 border-b font-semibold">{{ $lang[$lvl['label']] }}</td>
                                                            <td class="py-3 px-2 border-b">
                                                                <span class="text-lg font-bold">{{ $detail[$lvl['key']] ?? '00' }}</span>
                                                                <span class="text-[10px] ms-1">{{ $lang['Calories/Day'] }}</span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if(isset($detail['EER_child']))
                                <div class="w-full text-center">
                                    <p class="text-lg font-bold text-blue-700 mb-2 uppercase tracking-wide">{{ $lang['your'] }}</p>
                                    <div class="inline-block bg-[#2845F5] text-white rounded-2xl px-8 py-4 shadow-sm border border-blue-100">
                                        <span class="text-4xl font-extrabold">{{ $detail['EER'] }}</span>
                                        <span class="text-white font-semibold ms-2">{{ $lang['Calories/Day'] }}</span>
                                    </div>
                                    <p class="mt-6 text-sm  mx-auto leading-relaxed">{{ $lang['child1'] }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
