<div>
    <form wire:submit.prevent="calculate" class="row">

        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    {{-- Date --}}
                    <div class="space-y-2 relative">
                        <label for="date" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <input type="date" wire:model.defer="date" id="date" class="input" aria-label="input" />
                    </div>
                    {{-- Age --}}
                    <div class="space-y-2">
                        <label for="age" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" wire:model="age" step="any" id="age"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input"
                                placeholder="00">
                            <!-- Unit label as dropdown trigger -->
                            <label for="age_unit" class="absolute cursor-pointer text-sm underline right-6 top-4"
                                @click="open = !open">
                                {{ ucfirst($age_unit) }} ▾
                            </label>
                            <!-- Hidden input to bind selected unit -->
                            <input type="hidden" wire:model="age_unit" id="age_unit">
                            <!-- Dropdown items -->
                            <div x-show="open" x-cloak
                                class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0"
                                @click.away="open = false">
                                @foreach (['second' => $lang['5'], 'minutes' => $lang['6'], 'hours' => $lang['7'], 'days' => $lang['8'], 'weeks' => $lang['9'], 'months' => $lang['10'], 'years' => $lang['11']] as $value => $label)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer"
                                        wire:click="setPreUnit('{{ $value }}')" @click="open = false">
                                        {{ $label }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Choose Option --}}
                    <div class="space-y-2">
                        <label for="choose" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                        <select class="input" wire:model.defer="choose" id="choose">
                            <option value="after">{{ $lang['12'] }}</option>
                            <option value="before">{{ $lang['13'] }}</option>
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
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                            <div class="w-full text-center text-base">
                                <p>{{ $lang[4] }}</p>
                                <p class="my-3">
                                    <strong
                                        class=" bg-[#2845F5] text-white px-3 py-2 text-4xl rounded-lg text-blue">{{ round($detail['newYear'], 4) }}</strong>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        @endisset
    </form>


</div>
