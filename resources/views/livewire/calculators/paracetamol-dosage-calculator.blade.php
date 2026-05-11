<div>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Age --}}
                    <div class="w-full">
                        <label for="age" class="label text-blue">{!! $lang['1'] !!}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="age" id="age" step="any" class="input pr-20" placeholder="00">
                            <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3">{{ $age_unit }} ▾</span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-lg mt-1 right-0 w-32">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('age_unit', 'years'); open = false">years</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('age_unit', 'weeks'); open = false">weeks</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('age_unit', 'months'); open = false">months</p>
                            </div>
                        </div>
                    </div>

                    {{-- Weight --}}
                    <div class="w-full">
                        <label for="weight" class="label text-blue">{!! $lang['2'] !!}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="weight" id="weight" step="any" class="input pr-20" placeholder="00">
                            <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3">{{ $weight_unit }} ▾</span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-lg mt-1 right-0 w-32">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('weight_unit', 'kg'); open = false">kilograms (kg)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('weight_unit', 'lbs'); open = false">pounds (lbs)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Med Type --}}
                    <div class="w-full">
                        <label for="med_type" class="label text-blue">{!! $lang['3'] !!}:</label>
                        <div class="w-full mt-[7px]">
                            <select wire:model.live="med_type" id="med_type" class="input cursor-pointer">
                                <option value="1">{!! $lang['5'] !!} (120 mg/5 mL)</option>
                                <option value="2">{!! $lang['6'] !!} (250 mg/5 mL)</option>
                                <option value="3">{!! $lang['7'] !!} (500 mg)</option>
                                <option value="4">{!! $lang['8'] !!}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Custom Strength --}}
                    <div class="w-full" x-show="$wire.med_type === '4'" x-cloak>
                        <label for="ss" class="label text-blue">{!! $lang['4'] !!}:</label>
                        <div class="relative mt-[7px]">
                            <input type="number" wire:model.live="ss" id="ss" step="any" class="input pr-16" placeholder="00">
                            <span class="absolute right-4 top-3 text-blue text-sm">mg/mL</span>
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @elseif ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-5">
                            <div class="w-full">
                                @if(isset($detail['dose']))
                                    <p class="ml-5">
                                        <strong class="text-[#119154] text-[32px]">{{ round($detail['dose'], 2) }}</strong>
                                        <span class="text-[#119154] text-[20px]">{{ ($detail['med_type'] == "1" || $detail['med_type'] == "2") ? "(ml)" : "(tabl)" }}</span>
                                    </p>
                                @endif
                                @if(isset($detail['line']))
                                    <p><strong>{{ $detail['line'] }}</strong></p>
                                @endif
                                @if(isset($detail['solution_amount']))
                                    <p>
                                        <strong class="text-[#119154] text-[32px]">{{ round($detail['solution_amount'], 2) }}</strong>
                                        <span class="text-[#119154] text-[20px]">(mL)</span>
                                    </p>
                                @endif
                                <p class="mt-2">{{ $lang['11'] }}.</p>
                                <p class="mt-2"><span class="">{{ $lang['12'] }} <u>{{ $lang['13'] }}</u> {{ $lang['15'] }} is </span><strong class="text-[#119154]">{{ round($detail['fifteen'], 2) }}</strong><strong><span> (mg)</span></strong></p>
                                <p class="mt-2"><span class="">{{ $lang['12'] }} <u>{{ $lang['14'] }}</u> {{ $lang['15'] }} is </span><strong class="text-[#119154]">{{ round($detail['sixty'], 2) }}</strong><strong><span> (mg)</span></strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
