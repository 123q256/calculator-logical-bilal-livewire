<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-1 gap-4">
                    <div class="space-y-2 relative">
                        <label for="room_unit" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <select wire:model.live="room_unit" id="room_unit" class="input my-2">
                            <option value="1">{{ $lang['2'] }}</option>
                            <option value="2">{{ $lang['3'] }}</option>
                        </select>
                    </div>
                </div>

                @if ($room_unit == '1')
                    <div class="grid grid-cols-1 mt-4 lg:grid-cols-2 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="current_year" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                            <input type="text" wire:model.live="current_year" id="current_year" class="input" aria-label="input" placeholder="{{ date('Y') }}" />
                        </div>
                        <div class="space-y-2">
                            <label for="year" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                            <input type="text" wire:model.live="year" id="year" class="input" aria-label="input" placeholder="1998" />
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 mt-4 lg:grid-cols-2 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="birthday_unit" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                            <select wire:model.live="birthday_unit" id="birthday_unit" class="input my-2">
                                <option value="1">{{ $lang['7'] }}</option>
                                <option value="2">{{ $lang['8'] }}</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label for="age" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                            <input type="text" wire:model.live="age" id="age" class="input" aria-label="input" placeholder="20" />
                        </div>
                    </div>
                @endif
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>
        <hr>
        <div id="result-section">
            @isset($detail)
                <div wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                    <div class="">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                        <div class="rounded-lg flex items-center justify-center">
                            <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                                <div class="flex justify-center mt-4">
                                    <div class="text-center">
                                        <p class="text-lg font-semibold">{{ $lang['9'] }}</p>
                                        <p class="text-3xl bg-[#2845F5] text-white px-3 py-2 rounded-lg inline-block my-3">
                                            <strong class="text-white">{{ $detail['korean_age'] }}<span class="text-lg"> Year</span></strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </form>
</div>
