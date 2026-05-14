<div>
    <form wire:submit.prevent="calculate" x-data="{ age_unit_open: false, w_unit_open: false }">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <!-- Gender -->
                    <div class="space-y-2 relative">
                        <label for="gender" class="label">{{ $lang['gen'] }}:</label>
                        <div class="py-0">
                            <select wire:model.live="gender" id="gender" class="input">
                                <option value="1">{{ $lang['male'] }}</option>
                                <option value="0">{{ $lang['female'] }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Age -->
                    <div class="space-y-2">
                        <label for="age" class="label">{{ $lang['age'] }}:</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model.live="age" id="age" class="input p-2 w-full" placeholder="00" />
                            <label @click="age_unit_open = !age_unit_open" class="absolute cursor-pointer text-sm underline right-6 top-4 select-none">
                                <span x-text="$wire.age_unit"></span> ▾
                            </label>
                            <div x-show="age_unit_open" @click.away="age_unit_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md  w-auto mt-1 right-0 shadow-lg" style="display: none;">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('age_unit', 'days'); age_unit_open = false">days</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('age_unit', 'weeks'); age_unit_open = false">weeks</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('age_unit', 'months'); age_unit_open = false">months</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('age_unit', 'years'); age_unit_open = false">years</p>
                            </div>
                        </div>
                    </div>

                    <!-- Weight -->
                    <div class="space-y-2 lg:col-span-2 md:col-span-2">
                        <label for="weight" class="label">{{ $lang['weight'] ?? 'Weight' }}:</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model.live="weight" id="weight" class="input p-2 w-full" placeholder="00" />
                            <label @click="w_unit_open = !w_unit_open" class="absolute cursor-pointer text-sm underline right-6 top-4 select-none">
                                <span x-text="$wire.w_unit"></span> ▾
                            </label>
                            <div x-show="w_unit_open" @click.away="w_unit_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" style="display: none;">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('w_unit', 'g'); w_unit_open = false">grams (g)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('w_unit', 'dag'); w_unit_open = false">decagrams (dag)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('w_unit', 'kg'); w_unit_open = false">kilograms (kg)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('w_unit', 'oz'); w_unit_open = false">ounces (oz)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('w_unit', 'lbs'); w_unit_open = false">pounds (lbs)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
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
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg flex items-center justify-center">
                <div class="w-full p-3 rounded-lg mt-3">
                    <div class="w-full">
                        <div class="bg-[#F6FAFC] text-black border rounded-lg p-3">
                            {{ $lang[2] }} = <span class="text-2xl font-bold">{{ $detail['first_ans'] }}</span> {{ $lang[3] }}
                        </div>
                        <p class="lg:text-md mt-2" id="line">{!! $detail['line'] !!}</p>
                        <div class="mt-3">
                            <img src="{{ url('images/'.$detail['image'].'.png') }}" alt="Growth Chart" class="w-full object-cover" style="height: 116px;object-fit: fill;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</div>
