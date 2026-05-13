<div>
    <style>
        .active_tr { background-image: linear-gradient(45deg, #156ba1d0, #57b4eb) !important; }
        .active_tr td { color: white !important; }
        .bg-gradient { background: #2845F5; padding: 5px; }
        .scale-up { transform: scale(1.1); }
        .blue { background: #1565C0 }
        .teal { background: #006C61 }
        .green { background: #00C853 }
        .yellow { background: #FBC02D }
        .red { background: #FF1744 }
        .bg-sky { background-color: #f0f9ff; }
        .radius-10 { border-radius: 10px; }
        .br-top { border-top-left-radius: 10px; border-top-right-radius: 10px; }
        .font-s-32 { font-size: 32px; }
        .font-s-14 { font-size: 14px; }
        .font-s-12 { font-size: 12px; }
        .text-light-green { color: #2845F5; }
        .first_c, .second_c, .third_c, .fourth_c, .fifth_c { background-color: #2845F5 !important;color: white !important; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 mb-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 gap-4">
                    <!-- Gender Radio -->
                    <div class="col-span-12 px-2 flex mb-2 items-center">
                        <label class="pe-lg-3 pe-2 label">{!! $lang['gender'] !!}:</label>
                        <div class="flex gap-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" wire:model.live="gender" value="Male" class="form-radio h-4 w-4 text-blue-600">
                                <span class="ms-2 label">{{ $lang['male'] }}</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" wire:model.live="gender" value="Female" class="form-radio h-4 w-4 text-blue-600">
                                <span class="ms-2 label">{{ $lang['female'] }}</span>
                            </label>
                        </div>
                    </div>

                    <!-- Calculator Type Selector (Simple/Advance) -->
                    <div class="col-span-12 px-2 flex gap-2">
                        <label class="cursor-pointer">
                            <input type="radio" wire:model.live="calculator_type" value="simple" class="hidden">
                            <div class="px-4 py-2 rounded-lg font-bold transition {{ $calculator_type === 'simple' ? 'bg-[#2845F5] text-white' : 'bg-gray-100' }}">
                                Simple
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" wire:model.live="calculator_type" value="advance" class="hidden">
                            <div class="px-4 py-2 rounded-lg font-bold transition {{ $calculator_type === 'advance' ? 'bg-[#2845F5] text-white' : 'bg-gray-100' }}">
                                Advance
                            </div>
                        </label>
                    </div>

                    <!-- Method Selection (Only for Advance) -->
                    @if($calculator_type === 'advance')
                        <div class="col-span-11 px-2">
                            <label for="method" class="label">Methods:</label>
                            <div class="w-full py-2 relative" x-data="{ openModal: false }">
                                <select wire:model.live="method" id="method" class="input">
                                    <option value="1">{{ $lang['24'] ?? 'U.S. Navy' }}({{ $lang['22'] ?? 'Circumference' }})</option>
                                    <option value="2">{{ $lang['25'] ?? 'Jackson-Pollock' }} 7 ({{ $lang['23'] ?? 'Caliper' }})</option>
                                    <option value="3">{{ $lang['25'] ?? 'Jackson-Pollock' }} 4 ({{ $lang['23'] ?? 'Caliper' }})</option>
                                    <option value="4">{{ $lang['25'] ?? 'Jackson-Pollock' }} 3 ({{ $lang['23'] ?? 'Caliper' }})</option>
                                    <option value="5">{{ $lang['26'] ?? 'Parillo' }}({{ $lang['23'] ?? 'Caliper' }})</option>
                                    <option value="6">{{ $lang['27'] ?? 'Durnin/Wormsley' }}({{ $lang['23'] ?? 'Caliper' }})</option>
                                    <option value="7">{{ $lang['70'] ?? 'Estimate from BMI' }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-1 flex items-center mt-3" x-data="{ 
                                open: false,
                                getTitle() {
                                    const m = $wire.method;
                                    if(m == 1) return 'U.S. Navy Method';
                                    if(m == 2) return 'Jackson-Pollock 7 (Fat Caliper)';
                                    if(m == 3) return 'Jackson-Pollock 4 (Fat Caliper)';
                                    if(m == 4) return 'Jackson-Pollock 3 (Fat Caliper)';
                                    if(m == 5) return 'Parillo (Fat Caliper)';
                                    if(m == 6) return 'Durnin/Wormsley (Fat Caliper)';
                                    return 'Estimate from BMI';
                                },
                                getDesc() {
                                    const m = $wire.method;
                                    if(m == 1) return 'The US Navy method includes the neck, waist, and hip circumference measurements to estimate the body fat percentage.';
                                    if(m == 2) return 'This method includes measuring the thickness of subcutaneous fat at seven specific locations on your body using calipers.';
                                    if(m == 3) return 'This method estimates an individual\'s body fat percentage by measuring subcutaneous fat at four sites.';
                                    if(m == 4) return 'Designed to provide a quick and easy assessment of body fat, measuring only three specific sites of the body.';
                                    if(m == 5) return 'This method measures nine sites of your body. Good for individuals with higher muscle mass.';
                                    if(m == 6) return 'This method includes measuring skinfold thickness at four specific sites. Applicable to a wide range of individuals.';
                                    return 'Determine your body fat percentage based on your BMI along with gender, age, weight, and height.';
                                }
                            }">
                            <svg @click="open = true" class="cursor-pointer text-red-500 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <!-- Info Modal -->
                            <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">
                                <div @click.away="open = false" class="bg-white rounded-2xl p-6 max-w-sm w-full text-center">
                                    <p class="text-blue-700 font-bold text-lg mb-2" x-text="getTitle()"></p>
                                    <p class="text-sm mb-4" x-text="getDesc()"></p>
                                    <button type="button" @click="open = false" class="bg-blue-700 text-white px-6 py-2 rounded-full text-sm font-bold">Okay</button>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Common Inputs (Age, Weight, Height) -->
                    <div class="col-span-12 md:col-span-6 px-2">
                        <label for="age" class="label">{!! $lang['age_year'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="age" id="age" class="input" placeholder="25" />
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 px-2">
                        <label for="weight" class="label">{{ $lang['weight'] }}:</label>
                        <div class="relative w-full mt-2" x-data="{ open: false }">
                            <input type="number" wire:model.live="weight" id="weight" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit', 'lbs');" @click="open = false">lbs</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit', 'kg');" @click="open = false">kg</p>
                            </div>
                        </div>
                    </div>

                    <!-- Height -->
                    <div class="col-span-12 md:col-span-12 px-2">
                        <label class="label">{!! $lang['height'] !!} <span class="text-blue">({{ $unit_ft_in }})</span>:</label>
                        <div class="relative w-full mt-2" x-data="{ open: false }">
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
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit_ft_in', 'ft/in');" @click="open = false">ft/in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit_ft_in', 'cm');" @click="open = false">cm</p>
                            </div>
                        </div>
                    </div>

                    <!-- Circumference Inputs (Simple or Method 1) -->
                    @if($calculator_type === 'simple' || ($calculator_type === 'advance' && $method == '1'))
                        <div class="col-span-12 md:col-span-4 px-2" x-data="{ open: false }">
                            <label class="label flex items-center">
                                <span>{{ $lang['neck'] }} <span class="text-blue">({{ $unit_n }})</span>:</span>
                                <svg @click="open = true" class="ms-2 cursor-pointer text-gray-400 hover:text-blue-600 transition" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                            </label>
                            <div class="relative mt-2" x-data="{ openUnit: false }">
                                <input type="number" wire:model.live="neck" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label @click="openUnit = !openUnit" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit_n }} ▾</label>
                                <div x-show="openUnit" @click.away="openUnit = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit_n', 'in');" @click="openUnit = false">in</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit_n', 'cm');" @click="openUnit = false">cm</p>
                                </div>
                            </div>
                            <!-- Tip Modal -->
                            <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">
                                <div @click.away="open = false" class="bg-white rounded-2xl p-6 max-w-xs w-full text-center">
                                    <p class="text-blue-700 font-bold mb-4">Neck Measurement</p>
                                    <p class="text-xs mb-6 leading-relaxed">Measure just below the larynx (Adam's apple), with the tape sloping slightly downward to the front. Keep your neck relaxed and look straight ahead.</p>
                                    <button type="button" @click="open = false" class="bg-blue-700 text-white px-8 py-2 rounded-full text-xs font-bold uppercase">Close</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-4 px-2" x-data="{ open: false }">
                            <label class="label flex items-center">
                                <span>{{ $lang['waist'] }} <span class="text-blue">({{ $unit_w }})</span>:</span>
                                <svg @click="open = true" class="ms-2 cursor-pointer text-gray-400 hover:text-blue-600 transition" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                            </label>
                            <div class="relative mt-2" x-data="{ openUnit: false }">
                                <input type="number" wire:model.live="waist" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label @click="openUnit = !openUnit" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit_w }} ▾</label>
                                <div x-show="openUnit" @click.away="openUnit = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit_w', 'in');" @click="openUnit = false">in</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit_w', 'cm');" @click="openUnit = false">cm</p>
                                </div>
                            </div>
                            <!-- Tip Modal -->
                            <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">
                                <div @click.away="open = false" class="bg-white rounded-2xl p-6 max-w-xs w-full text-center">
                                    <p class="text-blue-700 font-bold mb-4">Waist Measurement</p>
                                    <p class="text-xs mb-6 leading-relaxed">For men, measure at the level of the navel. For women, measure at the narrowest part of the torso (usually just above the belly button).</p>
                                    <button type="button" @click="open = false" class="bg-blue-700 text-white px-8 py-2 rounded-full text-xs font-bold uppercase">Close</button>
                                </div>
                            </div>
                        </div>

                        @if($gender === 'Female')
                            <div class="col-span-12 md:col-span-4 px-2" x-data="{ open: false }">
                                <label class="label flex items-center">
                                    <span>{{ $lang['hip'] }} <span class="text-blue">({{ $unit_hip }})</span>:</span>
                                    <svg @click="open = true" class="ms-2 cursor-pointer text-gray-400 hover:text-blue-600 transition" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                </label>
                                <div class="relative mt-2" x-data="{ openUnit: false }">
                                    <input type="number" wire:model.live="hip" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                    <label @click="openUnit = !openUnit" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit_hip }} ▾</label>
                                    <div x-show="openUnit" @click.away="openUnit = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit_hip', 'in');" @click="openUnit = false">in</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit_hip', 'cm');" @click="openUnit = false">cm</p>
                                    </div>
                                </div>
                                <!-- Tip Modal -->
                                <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">
                                    <div @click.away="open = false" class="bg-white rounded-2xl p-6 max-w-xs w-full text-center">
                                        <p class="text-blue-700 font-bold mb-4">Hip Measurement</p>
                                        <p class="text-xs mb-6 leading-relaxed">Measure at the widest part of the buttocks or hips. Ensure the tape is level all the way around.</p>
                                        <button type="button" @click="open = false" class="bg-blue-700 text-white px-8 py-2 rounded-full text-xs font-bold uppercase">Close</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif

                    <!-- Skinfold Inputs (Caliper Methods) -->
                    @if($calculator_type === 'advance' && $method != '1' && $method != '7')
                        @php
                            $fields = [
                                'chest' => ['label' => $lang['28'] ?? 'Chest', 'methods' => [2, 5]],
                                'abd' => ['label' => $lang['29'] ?? 'Abdominal', 'methods' => [2, 3, 5]],
                                'thigh' => ['label' => $lang['30'] ?? 'Thigh', 'methods' => [2, 3, 4, 5]],
                                'tricep' => ['label' => $lang['31'] ?? 'Triceps', 'methods' => [2, 3, 4, 5, 6]],
                                'sub' => ['label' => $lang['32'] ?? 'Subscapular', 'methods' => [2, 5, 6]],
                                'sup' => ['label' => $lang['33'] ?? 'Suprailiac', 'methods' => [2, 3, 4, 5, 6]],
                                'mid' => ['label' => $lang['34'] ?? 'Midaxillary', 'methods' => [2]],
                                'bicep' => ['label' => $lang['35'] ?? 'Biceps', 'methods' => [5, 6]],
                                'back' => ['label' => $lang['36'] ?? 'Lower Back', 'methods' => [5]],
                                'calf' => ['label' => $lang['37'] ?? 'Calf', 'methods' => [5]],
                            ];
                        @endphp

                        @foreach($fields as $field => $data)
                            @if(in_array($method, $data['methods']))
                                <div class="col-span-12 md:col-span-6 px-2" x-data="{ 
                                        open: false,
                                        getImg() {
                                            const g = $wire.gender === 'Male' ? 'man' : 'women';
                                            const f = '{{ $field }}' === 'tricep' ? 'tri' : ('{{ $field }}' === 'bicep' ? 'bi' : '{{ $field }}');
                                            return '/images/' + g + '_' + f + '.png';
                                        },
                                        getTip() {
                                            const f = '{{ $field }}';
                                            const g = $wire.gender;
                                            const tips = {
                                                chest: g === 'Male' ? 'Pinch diagonally, halfway between armpit and nipple.' : 'Pinch diagonally, 1/3 way between armpit and nipple.',
                                                abd: 'Take a vertical pinch about 1 inch from your belly button.',
                                                thigh: 'Pinch vertically on the front of the thigh, midway between knee and hip.',
                                                tricep: 'Take a vertical pinch on the back of the arm, midway between shoulder and elbow.',
                                                sub: 'Take a diagonal pinch at a 45-degree angle below the shoulder blade.',
                                                sup: 'Take a diagonal pinch above the hip bone protrusion.',
                                                mid: 'Take a vertical pinch on the midaxillary line at nipple level.',
                                                bicep: 'Pinch vertically on the front of the upper arm over the bicep.',
                                                back: 'Take a pinch on the lower back above the belt line.',
                                                calf: 'Pinch vertically on the inside of the largest part of the calf.'
                                            };
                                            return tips[f] || '';
                                        }
                                    }">
                                    <label class="label flex items-center">
                                        <span>{!! $data['label'] !!}:</span>
                                        <svg @click="open = true" class="ms-2 cursor-pointer text-gray-400 hover:text-blue-600 transition" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                    </label>
                                    <div class="relative mt-2">
                                        <input type="number" step="any" wire:model.live="{{ $field }}" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="mm" />
                                        <span class="absolute right-4 top-3 text-xs text-gray-400">mm</span>
                                    </div>

                                    <!-- Tip Modal -->
                                    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">
                                        <div @click.away="open = false" class="bg-white rounded-2xl p-6 max-w-xs w-full text-center">
                                            <p class="text-blue-700 font-bold mb-4">{!! $data['label'] !!}</p>
                                            <div class="mb-4 flex justify-center">
                                                <img :src="getImg()" width="150" alt="tip image" class="rounded-lg">
                                            </div>
                                            <p class="text-xs mb-6 leading-relaxed" x-text="getTip()"></p>
                                            <button type="button" @click="open = false" class="bg-blue-700 text-white px-8 py-2 rounded-full text-xs font-bold uppercase">Close</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
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

        <!-- Result Section -->
        @isset($detail)
        <hr>
                <div  id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif

                <div class="">
                    <div class="w-full mt-3">

                            @if ($method == 1 || $calculator_type == 'simple')
                                <div class="col-lg-12 mx-auto">
                                    <div class="grid grid-cols-12 gap-3">
                                        <div class="col-span-12 md:col-span-6 pe-lg-2">
                                            <div class="bg-sky text-center border radius-10 p-3 ">
                                                <p><strong>{{ $lang['body_fat'] }}</strong></p>
                                                <p class="font-s-32"><strong
                                                        class="text-light-green">{{ $detail['army'] }}%</strong></p>
                                            </div>
                                        </div>

                                        <div class="col-span-12 md:col-span-6 ps-lg-2">
                                            <div class="bg-sky text-center border radius-10 p-3 ">
                                                <p><strong>Your Body Fat in {{ $detail['fat_weight_unit'] }}</strong></p>
                                                <p class="font-s-32">
                                                    <strong
                                                        class="text-light-green">{{ number_format($detail['fat_weight'], 2) }}
                                                        {{ $detail['fat_weight_unit'] }}</strong>
                                                </p>
                                            </div>
                                        </div>
                                        <p class="text-[12px] col-span-12 text-center font_w my-2">
                                            Note: It is generally recommended to maintain a body fat level of 15% or lower
                                            for men and 25% or lower for women.
                                        </p>
                                    </div>

                                    <div class="border radius-10 mt-3 statistics">
                                        <div class="row text-center ">
                                            <p class="text-[14px] py-2 font_w  bg-[#2845F5] text-white br-top ">1) American Council on
                                                Exercise ({{ $gender }}, Body Fat {{ $detail['army'] ?? $detail['body_fat'] }}%)</p>
                                        </div>
                                        <div class="w-full">
                                            <table class="table new_table w-full" cellspacing="0">
                                                <tbody>
                                                    <tr class="bg-gray ">
                                                        <td class='p-2 fw-bold'>Category</td>
                                                        <td class='p-2 fw-bold'>Body Fat</td>
                                                        <td class='p-2 fw-bold'>Weight</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 2 && $detail['army'] < 6 ? 'first_c' : '' }}">
                                                        <td class='p-2 border-b'>Essential</td>
                                                        <td class='p-2 border-b'>2 to 5.9 %</td>
                                                        <td class='p-2 border-b'>67 to 70 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 6 && $detail['army'] < 14 ? 'second_c' : '' }}">
                                                        <td class='p-2 border-b'>Athletes</td>
                                                        <td class='p-2 border-b'>6 to 13.9 %</td>
                                                        <td class='p-2 border-b'>70 to 76 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 14 && $detail['army'] < 18 ? 'third_c' : '' }}">
                                                        <td class='p-2 border-b'>Fitness</td>
                                                        <td class='p-2 border-b'>14 to 17.9 %</td>
                                                        <td class='p-2 border-b'>76 to 80 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 18 && $detail['army'] < 25 ? 'fourth_c' : '' }}">
                                                        <td class='p-2 border-b'>Acceptable</td>
                                                        <td class='p-2 border-b'>18 to 24.9 %</td>
                                                        <td class='p-2 border-b'>80 to 87 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 25 ? 'fifth_c' : '' }}">
                                                        <td class='p-2 border-b'>Obese</td>
                                                        <td class='p-2 border-b'>25 % and over</td>
                                                        <td class='p-2 border-b'>87 lb and over</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <div class="border radius-10 mt-3 statistics">
                                        <div class="row text-center ">
                                            <p class="text-[14px] py-2 font_w  bg-[#2845F5] text-white br-top ">2) WHO/NIH Guidelines,
                                                Gallagher et al. ({{ $gender }} {{ $age }} yrs, Body Fat {{ $detail['army'] ?? $detail['body_fat'] }} %)</p>
                                        </div>
                                        <div class="w-full">
                                            <table class="table new_table w-full" cellspacing="0">
                                                <tbody>
                                                    <tr class="bg-gray">
                                                        <td class='p-2 fw-bold'>Category</td>
                                                        <td class='p-2 fw-bold'>Body Fat</td>
                                                        <td class='p-2 fw-bold'>Weight</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) < 8 ? 'second_c' : '' }}">
                                                        <td class='p-2 border-b'>Underfat</td>
                                                        <td class='p-2 border-b'>under 8 %</td>
                                                        <td class='p-2 border-b'>under 71 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 8 && $detail['army'] < 20 ? 'third_c' : '' }}">
                                                        <td class='p-2 border-b'>Healthy</td>
                                                        <td class='p-2 border-b'>8 to 19.9 %</td>
                                                        <td class='p-2 border-b'>71 to 82 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 20 && $detail['army'] < 25 ? 'fourth_c' : '' }}">
                                                        <td class='p-2 border-b'>Overfat</td>
                                                        <td class='p-2 border-b'>20 to 24.9 %</td>
                                                        <td class='p-2 border-b'>82 to 87 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 25 ? 'fifth_c' : '' }}">
                                                        <td class='p-2 border-b'>Obese</td>
                                                        <td class='p-2 border-b'>25 % and over</td>
                                                        <td class='p-2 border-b'>87 lb and over</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="border radius-10 mt-3 statistics">
                                        <div class="row text-center ">
                                            <p class="text-[14px] py-2 font_w  bg-[#2845F5] text-white br-top ">3) American College of
                                                Sports Medicine* ({{ $gender }} {{ $age }} yrs, Body Fat {{ $detail['army'] ?? $detail['body_fat'] }}%)</p>
                                        </div>
                                        <div class="w-full">
                                            <table class="table new_table w-full" cellspacing="0">
                                                <tbody>
                                                    <tr class="bg-gray">
                                                        <td class='p-2 fw-bold'>Category</td>
                                                        <td class='p-2 fw-bold'>Body Fat</td>
                                                        <td class='p-2 fw-bold'>Weight</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 4.2 && $detail['army'] <= 7.8 ? 'first_c' : '' }}">
                                                        <td class='p-2 border-b'>Very Lean</td>
                                                        <td class='p-2 border-b'>4.2 to 7.8 %</td>
                                                        <td class='p-2 border-b'>68 to 71 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 7.9 && $detail['army'] <= 11.4 ? 'second_c' : '' }}">
                                                        <td class='p-2 border-b'>Excellent</td>
                                                        <td class='p-2 border-b'>7.9 to 11.4 %</td>
                                                        <td class='p-2 border-b'>71 to 74 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 11.5 && $detail['army'] <= 15.7 ? 'third_c' : '' }}">
                                                        <td class='p-2 border-b'>Good</td>
                                                        <td class='p-2 border-b'>11.5 to 15.7 %</td>
                                                        <td class='p-2 border-b'>74 to 78 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 15.8 && $detail['army'] <= 19.6 ? 'fourth_c' : '' }}">
                                                        <td class='p-2 border-b'>Fair</td>
                                                        <td class='p-2 border-b'>15.8 to 19.6 %</td>
                                                        <td class='p-2 border-b'>78 to 82 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 19.7 && $detail['army'] <= 24.8 ? 'fifth_c' : '' }}">
                                                        <td class='p-2 border-b'>Poor</td>
                                                        <td class='p-2 border-b'>19.7 to 24.8 %</td>
                                                        <td class='p-2 border-b'>82 to 87 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 24.9 ? 'fifth_c' : '' }}">
                                                        <td class='p-2 border-b'>Very Poor</td>
                                                        <td class='p-2 border-b'>24.9 % and over</td>
                                                        <td class='p-2 border-b'>87 lb and over</td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>



                                    <div class="row bg-gradient radius-10 hidden">
                                        <p class=" text-center text-white p-2" colspan="2">{{ $lang['13'] }}</p>
                                    </div>
                                    <div class="col-12 overflow-auto mt-2 table-wrapper hidden">
                                        <table class="col-12 table-border radius-10" cellspacing="0">
                                            <thead class="mb-2">

                                            </thead>
                                            <tbody class="top-table">

                                                <tr>
                                                    <td class="px-3 py-2">{{ $lang['fat_mass'] }}</td>
                                                    <td class="text-center px-3 py-2"><strong
                                                            class="text-blue">{{ $detail['fat_mass'] }} kg</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="px-3 py-2">{{ $lang['lean_mass'] }}</td>
                                                    <td class="text-center px-3 py-2"><strong
                                                            class="text-blue">{{ $detail['lean_mass'] }} kg</strong></td>
                                                </tr>
                                                <tr class="hidden">
                                                    <td class="px-3 py-2">{{ $lang['child'] }}</td>
                                                    <td class="text-center px-3 py-2"><strong
                                                            class="text-blue">{{ $detail['child_body_fat'] }} %</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="px-3 py-2">{{ $lang['adult'] }}</td>
                                                    <td class="text-center px-3 py-2"><strong
                                                            class="text-blue">{{ $detail['adult_body_fat'] }} %</strong>
                                                    </td>
                                                </tr>
                                                <tr
                                                    class="{{ isset($gender) && $gender === 'Female' ? '' : 'hidden' }}">
                                                    <td class="px-3 py-2">{{ $lang['bai'] }}</td>
                                                    <td class="text-center px-3 py-2"><strong
                                                            class="text-blue">{{ $detail['BAI'] }} %</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="col-md-10 relative mx-auto" style="top:-12px">
                                        <div class="flex flex-column flex-sm-row text-center font-s-14 hidden">
                                            <div
                                                class="col blue px-2 py-1 radius-sm-10 radius-l-10 {{ isset($detail['Essential']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['1'] }}</p>
                                                <span
                                                    class="text-white">{{ $gender == 'Female' ? '10-13 %' : '2-5 %' }}</span>
                                            </div>
                                            <div
                                                class="col teal text-white radius-sm-10 px-2 py-1 mt-1 mt-sm-0 {{ isset($detail['Athletes']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['2'] }}</p>
                                                <span
                                                    class="text-white">{{ $gender == 'Female' ? '14-20 %' : '6-13 %' }}</span>
                                            </div>
                                            <div
                                                class="col green text-white radius-sm-10 px-2 py-1 mt-1 mt-sm-0 {{ isset($detail['Fitness']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['3'] }}</p>
                                                <span
                                                    class="text-white">{{ $gender == 'Female' ? '21-24 %' : '14-17 %' }}</span>
                                            </div>
                                            <div
                                                class="col yellow text-white radius-sm-10 px-2 py-1 mt-1 mt-sm-0 {{ isset($detail['Average']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['4'] }}</p>
                                                <span
                                                    class="text-white">{{ $gender == 'Female' ? '25-31 %' : '18-25 %' }}</span>
                                            </div>
                                            <div
                                                class="col red text-white radius-sm-10 px-2 py-1 mt-1 mt-sm-0 radius-r-10 {{ isset($detail['Obese']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['5'] }}</p>
                                                <span
                                                    class="text-white">{{ $gender == 'Female' ? '31+ %' : '25+ %' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row hidden">
                                        <div class="col-lg-3 p-2">
                                            <div class="bg-sky text-center border radius-10 px-3 py-2">
                                                <p class="font-s-12"><strong>{{ $lang['6'] }}</strong></p>
                                                <p><strong class="text-blue">{{ $detail['army'] }}%</strong></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-2">
                                            <div class="bg-sky text-center border radius-10 px-3 py-2">
                                                <p class="font-s-12"><strong>{{ $lang['7'] }}</strong></p>
                                                <p><strong class="text-blue">{{ $detail['body_fat'] }}%</strong></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-2">
                                            <div class="bg-sky text-center border radius-10 px-3 py-2">
                                                <p class="font-s-12"><strong>{{ $lang['8'] }}</strong></p>
                                                <p><strong class="text-blue">{{ $detail['army'] }}%</strong></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-2">
                                            <div class="bg-sky text-center border radius-10 px-3 py-2">
                                                <p class="font-s-12"><strong>{{ $lang['9'] }}</strong></p>
                                                <p><strong class="text-blue">{{ $detail['ymca'] }}%</strong></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @else
                                <div class="col-lg-12 mx-auto">
                                    <div class="row">
                                        <div class="col-md-6 pe-md-2">
                                            <div class="bg-sky text-center border radius-10 p-3 ">
                                                <p><strong>{{ $lang['body_fat'] }}</strong></p>
                                                <p class="font-s-32"><strong
                                                        class="text-light-green">{{ $detail['body_fat'] }}%</strong></p>
                                            </div>
                                        </div>

                                        <div class="col-md-6 ps-md-2 mt-2 mt-md-0">
                                            <div class="bg-sky text-center border radius-10 p-3 ">
                                                <p><strong>Your Body Fat in {{ $detail['fat_weight_unit'] }}</strong></p>
                                                <p class="font-s-32">
                                                    <strong
                                                        class="text-light-green">{{ number_format($detail['fat_weight'], 2) }}
                                                        {{ $detail['fat_weight_unit'] }}</strong>
                                                </p>
                                            </div>
                                        </div>

                                        <p class="font-s-12 text-center font_w my-2">
                                            Note: It is generally recommended to maintain a body fat level of 15% or lower
                                            for men and 25% or lower for women.
                                        </p>
                                    </div>

                                    <div class="row bg-gradient radius-10">
                                        <p class=" text-center text-white p-2" colspan="2">
                                            {{ isset($lang['secoun_table_h']) ? $lang['secoun_table_h'] : 'Body Fat Percentage Ranges' }}
                                        </p>
                                    </div>

                                    <div class="w-full overflow-auto mt-2 table-wrapper ">
                                        <table class="w-full" cellspacing="0">
                                            <tbody class="">

                                                <tr>
                                                    <th class="text-start border-b p-2">{{ $lang['10'] }}</th>
                                                    <th class="text-start border-b p-2">{{ $lang['11'] }}</th>
                                                    <th class="text-start border-b p-2">{{ $lang['12'] }}</th>
                                                </tr>
                                                <tr
                                                    class="{{ isset($detail['Essential']) ? $detail['Essential'] : '' }}">
                                                    <td class="border-b p-2">{{ $lang['1'] }}</td>
                                                    <td class="border-b p-2">10-13 %</td>
                                                    <td class="border-b p-2">2-5 %</td>
                                                </tr>
                                                <tr class="{{ isset($detail['Athletes']) ? $detail['Athletes'] : '' }}">
                                                    <td class="border-b p-2">{{ $lang['2'] }}</td>
                                                    <td class="border-b p-2">14-20 %</td>
                                                    <td class="border-b p-2">6-13 %</td>
                                                </tr>
                                                <tr class="{{ isset($detail['Fitness']) ? $detail['Fitness'] : '' }}">
                                                    <td class="border-b p-2">{{ $lang['3'] }}</td>
                                                    <td class="border-b p-2">21-24 %</td>
                                                    <td class="border-b p-2">14-17 %</td>
                                                </tr>
                                                <tr class="{{ isset($detail['Average']) ? $detail['Average'] : '' }}">
                                                    <td class="border-b p-2">{{ $lang['4'] }}</td>
                                                    <td class="border-b p-2">25-31 %</td>
                                                    <td class="border-b p-2">18-25 %</td>
                                                </tr>
                                                <tr class="{{ isset($detail['Obese']) ? $detail['Obese'] : '' }}">
                                                    <td class="p-2">{{ $lang['5'] }}</td>
                                                    <td class="p-2">31+ %</td>
                                                    <td class="p-2">25+ %</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="border radius-10 mt-3 statistics">
                                        <div class="row text-center ">
                                            <p class="text-[14px] py-2 font_w  bg-[#2845F5] text-white br-top ">1) American Council on
                                                Exercise ({{ $gender }}, Body Fat {{ $detail['army'] ?? $detail['body_fat'] }}%)</p>
                                        </div>
                                        <div class="w-full">
                                            <table class="table new_table w-full" cellspacing="0">
                                                <tbody>
                                                    <tr class="bg-gray ">
                                                        <td class='p-2 fw-bold'>Category</td>
                                                        <td class='p-2 fw-bold'>Body Fat</td>
                                                        <td class='p-2 fw-bold'>Weight</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 2 && $detail['body_fat'] < 6 ? 'first_c' : '' }}">
                                                        <td class='p-2 border-b'>Essential</td>
                                                        <td class='p-2 border-b'>2 to 5.9 %</td>
                                                        <td class='p-2 border-b'>67 to 70 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 6 && $detail['body_fat'] < 14 ? 'second_c' : '' }}">
                                                        <td class='p-2 border-b'>Athletes</td>
                                                        <td class='p-2 border-b'>6 to 13.9 %</td>
                                                        <td class='p-2 border-b'>70 to 76 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 14 && $detail['body_fat'] < 18 ? 'third_c' : '' }}">
                                                        <td class='p-2 border-b'>Fitness</td>
                                                        <td class='p-2 border-b'>14 to 17.9 %</td>
                                                        <td class='p-2 border-b'>76 to 80 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 18 && $detail['body_fat'] < 25 ? 'fourth_c' : '' }}">
                                                        <td class='p-2 border-b'>Acceptable</td>
                                                        <td class='p-2 border-b'>18 to 24.9 %</td>
                                                        <td class='p-2 border-b'>80 to 87 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 25 ? 'fifth_c' : '' }}">
                                                        <td class='p-2 border-b'>Obese</td>
                                                        <td class='p-2 border-b'>25 % and over</td>
                                                        <td class='p-2 border-b'>87 lb and over</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <div class="border radius-10 mt-3 statistics">
                                        <div class="row text-center ">
                                            <p class="text-[14px] py-2 font_w  bg-[#2845F5] text-white br-top ">2) WHO/NIH Guidelines,
                                                Gallagher et al. (Male 20 to 39 yrs, Body Fat 59 %)</p>
                                        </div>
                                        <div class="w-full">
                                            <table class="table new_table w-full" cellspacing="0">
                                                <tbody>
                                                    <tr class="bg-gray">
                                                        <td class='p-2 fw-bold'>Category</td>
                                                        <td class='p-2 fw-bold'>Body Fat</td>
                                                        <td class='p-2 fw-bold'>Weight</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) < 8 ? 'second_c' : '' }}">
                                                        <td class='p-2 border-b'>Underfat</td>
                                                        <td class='p-2 border-b'>under 8 %</td>
                                                        <td class='p-2 border-b'>under 71 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 8 && $detail['body_fat'] < 20 ? 'third_c' : '' }}">
                                                        <td class='p-2 border-b'>Healthy</td>
                                                        <td class='p-2 border-b'>8 to 19.9 %</td>
                                                        <td class='p-2 border-b'>71 to 82 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 20 && $detail['body_fat'] < 25 ? 'fourth_c' : '' }}">
                                                        <td class='p-2 border-b'>Overfat</td>
                                                        <td class='p-2 border-b'>20 to 24.9 %</td>
                                                        <td class='p-2 border-b'>82 to 87 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 25 ? 'fifth_c' : '' }}">
                                                        <td class='p-2 border-b'>Obese</td>
                                                        <td class='p-2 border-b'>25 % and over</td>
                                                        <td class='p-2 border-b'>87 lb and over</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="border radius-10 mt-3 statistics">
                                        <div class="row text-center ">
                                            <p class="text-[14px] py-2 font_w  bg-[#2845F5] text-white br-top ">3) American College of
                                                Sports Medicine* ({{ $gender }} {{ $age }} yrs, Body Fat {{ $detail['army'] ?? $detail['body_fat'] }}%)</p>
                                        </div>
                                        <div class="w-full">
                                            <table class="table new_table w-full" cellspacing="0">
                                                <tbody>
                                                    <tr class="bg-gray">
                                                        <td class='p-2 fw-bold'>Category</td>
                                                        <td class='p-2 fw-bold'>Body Fat</td>
                                                        <td class='p-2 fw-bold'>Weight</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 4.2 && $detail['body_fat'] <= 7.8 ? 'first_c' : '' }}">
                                                        <td class='p-2 border-b'>Very Lean</td>
                                                        <td class='p-2 border-b'>4.2 to 7.8 %</td>
                                                        <td class='p-2 border-b'>68 to 71 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 7.9 && $detail['body_fat'] <= 11.4 ? 'second_c' : '' }}">
                                                        <td class='p-2 border-b'>Excellent</td>
                                                        <td class='p-2 border-b'>7.9 to 11.4 %</td>
                                                        <td class='p-2 border-b'>71 to 74 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 11.5 && $detail['body_fat'] <= 15.7 ? 'third_c' : '' }}">
                                                        <td class='p-2 border-b'>Good</td>
                                                        <td class='p-2 border-b'>11.5 to 15.7 %</td>
                                                        <td class='p-2 border-b'>74 to 78 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 15.8 && $detail['body_fat'] <= 19.6 ? 'fourth_c' : '' }}">
                                                        <td class='p-2 border-b'>Fair</td>
                                                        <td class='p-2 border-b'>15.8 to 19.6 %</td>
                                                        <td class='p-2 border-b'>78 to 82 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 19.7 && $detail['body_fat'] <= 24.8 ? 'fifth_c' : '' }}">
                                                        <td class='p-2 border-b'>Poor</td>
                                                        <td class='p-2 border-b'>19.7 to 24.8 %</td>
                                                        <td class='p-2 border-b'>82 to 87 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 24.9 ? 'fifth_c' : '' }}">
                                                        <td class='p-2 border-b'>Very Poor</td>
                                                        <td class='p-2 border-b'>24.9 % and over</td>
                                                        <td class='p-2 border-b'>87 lb and over</td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>


                                    <div class="col-md-10 relative mx-auto" style="top:-12px">
                                        <div class="flex flex-column flex-sm-row text-center font-s-14 hidden">
                                            <div
                                                class="col blue px-2 py-1 radius-sm-10 radius-l-10 {{ isset($detail['Essential']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['1'] }}</p>
                                                <span
                                                    class="text-white">{{ $gender == 'Female' ? '10-13 %' : '2-5 %' }}</span>
                                            </div>
                                            <div
                                                class="col teal text-white radius-sm-10 px-2 py-1 mt-1 mt-sm-0 {{ isset($detail['Athletes']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['2'] }}</p>
                                                <span
                                                    class="text-white">{{ $gender == 'Female' ? '14-20 %' : '6-13 %' }}</span>
                                            </div>
                                            <div
                                                class="col green text-white radius-sm-10 px-2 py-1 mt-1 mt-sm-0 {{ isset($detail['Fitness']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['3'] }}</p>
                                                <span
                                                    class="text-white">{{ $gender == 'Female' ? '21-24 %' : '14-17 %' }}</span>
                                            </div>
                                            <div
                                                class="col yellow text-white radius-sm-10 px-2 py-1 mt-1 mt-sm-0 {{ isset($detail['Average']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['4'] }}</p>
                                                <span
                                                    class="text-white">{{ $gender == 'Female' ? '25-31 %' : '18-25 %' }}</span>
                                            </div>
                                            <div
                                                class="col red text-white radius-sm-10 px-2 py-1 mt-1 mt-sm-0 radius-r-10 {{ isset($detail['Obese']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['5'] }}</p>
                                                <span
                                                    class="text-white">{{ $gender == 'Female' ? '31+ %' : '25+ %' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row hidden">
                                        <div class="col-lg-6 p-2">
                                            <div class="bg-sky text-center border radius-10 px-3 py-2">
                                                <p><strong>{{ $lang['fat_mass'] }}</strong></p>
                                                <p><strong class="text-green">{{ $detail['body_fat_w'] }}</strong></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-2">
                                            <div class="bg-sky text-center border radius-10 px-3 py-2">
                                                <p><strong>{{ $lang['lean_mass'] }}</strong></p>
                                                <p><strong class="text-green">{{ $detail['lbm'] }}</strong></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        </div>
                </div>
            </div>
        @endisset
    </form>
</div>
