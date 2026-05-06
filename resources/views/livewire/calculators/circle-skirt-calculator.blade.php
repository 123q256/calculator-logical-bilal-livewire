<div x-data="{ dropdowns: {} }">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 mt-3 gap-8 items-center">
                    <div class="space-y-6">
                        {{-- Skirt Type --}}
                        <div class="w-full">
                            <label for="type" class="label">{{ $lang['1'] }}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="skirt_type" id="type" class="input">
                                    <option value="full">{{ $lang['2'] }}</option>
                                    <option value="three-quarter">{{ $lang['3'] }}</option>
                                    <option value="half">{{ $lang['4'] }}</option>
                                    <option value="quarter">{{ $lang['5'] }}</option>
                                </select>
                            </div>
                        </div>

                        {{-- Waist Measurement --}}
                        <div class="w-full">
                            <label for="waist" class="label">{{ $lang['6'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live.debounce.500ms="waist" id="waist" step="any" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['waist_unit'] = !dropdowns['waist_unit']">
                                    {{ $waist_unit }} ▾
                                </label>
                                <div x-show="dropdowns['waist_unit']" @click.away="dropdowns['waist_unit'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl" x-cloak>
                                    @foreach (['mm', 'cm', 'm', 'ft', 'in'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('waist_unit', '{{ $unit }}'); dropdowns['waist_unit'] = false">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Skirt Length --}}
                        <div class="w-full">
                            <label for="length" class="label">{{ $lang['4'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live.debounce.500ms="length" id="length" step="any" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['length_unit'] = !dropdowns['length_unit']">
                                    {{ $length_unit }} ▾
                                </label>
                                <div x-show="dropdowns['length_unit']" @click.away="dropdowns['length_unit'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl" x-cloak>
                                    @foreach (['mm', 'cm', 'm', 'ft', 'in'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('length_unit', '{{ $unit }}'); dropdowns['length_unit'] = false">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Dynamic Skirt Image --}}
                    <div class="text-center flex justify-center items-center h-full">
                        <img src="{{ asset('images/' . $skirt_type . '.svg') }}" alt="skirt" class="set_img max-w-full h-auto transition-all duration-300 transform scale-110" style="max-height: 260px;">
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>
<hr>
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result my-8">
               <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full mt-3">
                        <p class="text-[18px] mt-2"><strong>{{ $lang['8']}}</strong></p>
                        <div class="w-full md:w-[60%] lg:w-[60%] text-[20px} overflow-auto my-3">
                            <table class="w-full">
                                <tr>
                                    <td class="border-b py-2">{{$lang['10']}} :</td>
                                    <td class="border-b py-2">{{$detail['radius_cm'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang['11']}} :</td>
                                    <td class="border-b py-2">{{ $detail['radius_mm'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang['12']}} :</td>
                                    <td class="border-b py-2">{{ $detail['radius_m'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang['13']}} :</td>
                                    <td class="border-b py-2">{{ $detail['radius_in'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang['14']}} :</td>
                                    <td class="border-b py-2">{{ $detail['radius_ft'] }}</td>
                                </tr>
                            </table>
                        </div>
                        <p class="text-[20px] mt-2"><strong>{{ $lang['9']}}</strong></p>
                        <div class="w-full md:w-[60%] lg:w-[60%] font-s-18 overflow-auto mt-2">
                            <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2">{{$lang['10']}} :</td>
                                        <td class="border-b py-2">{{$detail['fabric_length_cm'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['11']}} :</td>
                                        <td class="border-b py-2">{{ $detail['fabric_length_mm'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['12']}} :</td>
                                        <td class="border-b py-2">{{ $detail['fabric_length_m'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['13']}} :</td>
                                        <td class="border-b py-2">{{ $detail['fabric_length_in'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['14']}} :</td>
                                        <td class="border-b py-2">{{ $detail['fabric_length_ft'] }}</td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
        @endisset
    </form>
</div>
