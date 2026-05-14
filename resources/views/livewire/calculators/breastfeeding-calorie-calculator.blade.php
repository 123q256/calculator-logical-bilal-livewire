<div>
    <style>
        .tagsUnit { background-color: #2845F5 !important; color: white !important; }
        .hover_tags:hover { background-color: #2845F5 !important; color: white !important; }
        .bg-light-blue { background-color: #F0F7FF; }
        .text-blue { color: #2845F5; }
        .border-blue { border-color: #2845F5; }
        .input_unit { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); font-weight: bold; color: #666; }
        .highcharts-credits { display: none; }
        .result_calculator select {
            width: 100%;
            min-height: 46px;
            padding: 10px 14px;
            border-radius: 14px;
            border: 1px solid #d1d5db;
            background: #f9fafc;
            font-size: 14px;
            color: #111827;
            outline: none;
            transition: 0.15s;
            resize: vertical;
        }
    </style>

    <form wire:submit.prevent="calculate" x-data="{ unit_type: @entangle('unit_type') }">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-6">
                    <div class="col-span-12">
                        <div class="grid grid-cols-12 lg:gap-4">
                            <div class="col-span-12 md:col-span-6 lg:col-span-6 flex items-center">
                                <h2 class="text-xl font-bold">{{ $lang['title'] ?? 'Breastfeeding Calories' }}</h2>
                            </div>

                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 w-full">
                                <div class="lg:w-1/2 w-full px-2 py-1">
                                    <button type="button" @click="$wire.setUnitType('lbs')" :class="unit_type === 'lbs' ? 'tagsUnit' : 'bg-white'" class="w-full px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white">
                                        {{ $lang['imperial'] }}
                                    </button>
                                </div>
                                <div class="lg:w-1/2 w-full px-2 py-1">
                                    <button type="button" @click="$wire.setUnitType('kg')" :class="unit_type === 'kg' ? 'tagsUnit' : 'bg-white'" class="w-full px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white">
                                        {{ $lang['metric'] }}
                                    </button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Age & Height -->
                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{{ $lang['age'] }}:</label>
                        <div class="py-2">
                            <input type="number" step="any" wire:model.live="age" class="input" placeholder="00">
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{{ $lang['height'] }}:</label>
                        <div class="py-2">
                            <!-- Imperial Height (Dropdown) -->
                            <div x-show="unit_type === 'lbs'" style="{{ $unit_type === 'lbs' ? '' : 'display: none;' }}">
                                <select wire:model.live="ft_in" class="input">
                                    @foreach(["55"=>"4ft 7in","56"=>"4ft 8in","57"=>"4ft 9in","58"=>"4ft 10in","59"=>"4ft 11in","60"=>"5ft 0in","61"=>"5ft 1in","62"=>"5ft 2in","63"=>"5ft 3in","64"=>"5ft 4in","65"=>"5ft 5in","66"=>"5ft 6in","67"=>"5ft 7in","68"=>"5ft 8in","69"=>"5ft 9in","70"=>"5ft 10in","71"=>"5ft 11in","72"=>"6ft 0in","73"=>"6ft 1in","74"=>"6ft 2in","75"=>"6ft 3in","76"=>"6ft 4in","77"=>"6ft 5in","78"=>"6ft 6in","79"=>"6ft 7in","80"=>"6ft 8in","81"=>"6ft 9in","82"=>"6ft 10in","83"=>"6ft 11in","84"=>"7ft 0in"] as $val => $name)
                                        <option value="{{ $val }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Metric Height (Input) -->
                            <div x-show="unit_type === 'kg'" style="{{ $unit_type === 'kg' ? '' : 'display: none;' }}" class="relative w-full">
                                <input type="number" step="any" wire:model.live="height_cm" class="input pr-12" placeholder="00">
                                <span class="input_unit">cm</span>
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: Weight & Activity -->
                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{{ $lang['weight'] }}:</label>
                        <div class="relative w-full py-2">
                            <input type="number" step="any" wire:model.live="weight" class="input pr-12" placeholder="00">
                            <span class="input_unit" x-text="unit_type"></span>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{{ $lang['activity'] }}:</label>
                        <div class="py-2">
                            <select wire:model.live="activity" class="input">
                                <option value="1.2">Little to no exercise</option>
                                <option value="1.25">Light exercise (1-3 days per week)</option>
                                <option value="1.375">Moderate Exercise (3-5 days per week)</option>
                                <option value="1.55">Heavy Exercise (6-7 days per week)</option>
                                <option value="1.725">Very Heavy Exercise (twice per day)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 4: Breastfeeding Intensity & Pregnancy -->
                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{{ $lang['bf'] }}:</label>
                        <div class="py-2">
                            <select wire:model.live="bf" class="input">
                                <option value="500">Exclusive Breastfeeding</option>
                                <option value="400">Mostly Breastfeeding</option>
                                <option value="250">Partial Breastfeeding</option>
                                <option value="0">Not Breastfeeding</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{{ $lang['pregnant'] }}:</label>
                        <div class="py-2">
                            <select wire:model.live="pregnant" class="input">
                                <option value="0">Not Pregnant</option>
                                <option value="50">First Trimester</option>
                                <option value="340">Second Trimester</option>
                                <option value="450">Third Trimester</option>
                                <option value="700">Third Trimester (Twins)</option>
                            </select>
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
        </div>
    </form>

    <!-- Result Section -->
    @isset($detail)
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
        <div >
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="flex flex-wrap justify-between">
                            <div class="mt-2">
                                <p><strong>{{ $lang['maintain'] }}</strong></p>
                                <p>
                                    <strong class="text-[28px] text-green-500">{{ $detail['maintain'] }}</strong>
                                    <span class="text-[20px]">Kcal/day</span>
                                </p>
                            </div>
                            <div class="border-r hidden md:block lg:block">&nbsp;</div>
                            <div class="mt-2">
                                <p><strong>{{ $lang['lose'] }}</strong></p>
                                <p>
                                    <strong class="text-[28px] text-green-500">{{ $detail['lose'] }}</strong>
                                    <span class="text-[20px]">Kcal/day</span>
                                </p>
                            </div>
                            <div class="border-r hidden md:block lg:block">&nbsp;</div>
                            <div class="mt-2">
                                <p><strong>{{ $lang['supply'] }}</strong></p>
                                <p>
                                    <strong class="text-[28px] text-green-500">{{ $detail['supply'] }}</strong>
                                    <span class="text-[20px]">Kcal/day</span>
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 mt-4">
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <table class="w-full" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['carbo'] }}</strong></td>
                                        <td class="border-b py-2"><strong>{{ $detail['carbos1'] }}g</strong></td>
                                    </tr>
                                    <tr class="bdr-top">
                                        <td class="border-b py-2"><strong>{{ $lang['proteins'] }}</strong></td>
                                        <td class="border-b py-2"><strong>{{ $detail['proteins1'] }}g</strong></td>
                                    </tr>
                                    <tr class="bdr-top boder_bottom_none">
                                        <td class="border-b py-2"><strong>{{ $lang['fats'] }}</strong></td>
                                        <td class="border-b py-2"><strong>{{ $detail['fats1'] }}g</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6 md:border-l-2 lg:border-l-2 md:px-3 lg:px-3">
                                <table class="w-full" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['carbo'] }}</strong></td>
                                        <td class="border-b py-2"><strong>{{ $detail['carbos2'] }}g</strong></td>
                                    </tr>
                                    <tr class="bdr-top">
                                        <td class="border-b py-2"><strong>{{ $lang['proteins'] }}</strong></td>
                                        <td class="border-b py-2"><strong>{{ $detail['proteins2'] }}g</strong></td>
                                    </tr>
                                    <tr class="bdr-top boder_bottom_none">
                                        <td class="border-b py-2"><strong>{{ $lang['fats'] }}</strong></td>
                                        <td class="border-b py-2"><strong>{{ $detail['fats2'] }}g</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</div>
