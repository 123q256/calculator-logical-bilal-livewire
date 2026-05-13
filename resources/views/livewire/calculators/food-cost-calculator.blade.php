<div>
    <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if ($error)
            <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-2 md:gap-4 lg:gap-4">
                {{-- Unit System Selector --}}
                <div class="col-span-12">
                    <div class="col-12 mx-auto mt-2 w-full">
                        <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 py-1">
                            <div class="lg:w-1/2 w-full px-2 py-1">
                                <div wire:click="setFoodType('food_piece')" class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $food_type === 'food_piece' ? 'tagsUnit' : 'bg-white' }}">
                                    {{ $lang[1] }}
                                </div>
                            </div>
                            <div class="lg:w-1/2 w-full px-2 py-1">
                                <div wire:click="setFoodType('food_case')" class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $food_type === 'food_case' ? 'tagsUnit' : 'bg-white' }}">
                                    {{ $lang[2] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Menu Item Name --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="menu" class="label">{!! $lang['3'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model.live="menu" id="menu" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>

                {{-- Unit of Measure --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="measure_unit" class="label">{!! $lang['4'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="measure_unit" id="measure_unit" class="input">
                            @foreach(["Units","Pieces","Cups","Ounces","Sheets","Pounds","Grams","Liters","Meters"] as $unit)
                                <option value="{{ $unit }}">{{ $unit }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Units per Case --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="units_case" class="label"><span class="text-blue">{{ $measure_unit }}</span> {!! $lang['6'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model.live="units_case" id="units_case" class="input" aria-label="input" placeholder="00" required />
                    </div>
                </div>

                {{-- Cost per Unit --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="cost_unit" class="label" id="change_text">
                        {{ $food_type === 'food_piece' ? $lang[7] : $lang[16] }}:
                    </label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model.live="cost_unit" id="cost_unit" class="input" aria-label="input" placeholder="00" required />
                    </div>
                </div>

                {{-- Serving Size --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="serving_size" class="label">{!! $lang['8'] !!} (<span class="text-blue">{{ $measure_unit }}</span>):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model.live="serving_size" id="serving_size" class="input" aria-label="input" placeholder="00" required />
                    </div>
                </div>

                {{-- Other Cost --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="other" class="label">{!! $lang['9'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model.live="other" id="other" class="input" aria-label="input" placeholder="00" required />
                    </div>
                </div>

                {{-- Menu Price --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="menu_price" class="label">{!! $lang['10'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model.live="menu_price" id="menu_price" class="input" aria-label="input" placeholder="00" required />
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

    @if ($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full mt-2">
                            <div class="w-full overflow-auto">
                                <table class="w-full md:w-[70%] lg:w-[70%]" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[11] }}</strong></td>
                                        <td class="border-b py-2"><strong>{{ $detail['food_cost'] }} %</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[12] }}</strong></td>
                                        <td class="border-b py-2"><strong>{{ ($detail['costPerServing'] <= 0) ? "-" : "" }} {{ $currancy }} {{ abs($detail['costPerServing']) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[13] }}</strong></td>
                                        <td class="border-b py-2"><strong>{{ ($detail['costPerPlate'] <= 0) ? "-" : "" }} {{ $currancy }} {{ abs($detail['costPerPlate']) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[14] }}</strong></td>
                                        <td class="border-b py-2"><strong>{{ ($detail['contributionPerPlate'] <= 0) ? "-" : "" }} {{ $currancy }} {{ abs($detail['contributionPerPlate']) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[15] }}</strong></td>
                                        <td class="border-b py-2"><strong>{{ ($detail['profitPerCase'] <= 0) ? "-" : "" }} {{ $currancy }} {{ abs($detail['profitPerCase']) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2"><strong>{{ $lang[7] }}</strong></td>
                                        <td class="py-2"><strong>{{ ($detail['costPerUnit'] <= 0) ? "-" : "" }} {{ $currancy }} {{ abs($detail['costPerUnit']) }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
