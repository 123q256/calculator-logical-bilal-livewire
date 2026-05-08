<div x-data="{ dropdowns: {} }">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $selection === 'size' ? 'tagsUnit' : '' }}" @click="$wire.set('selection', 'size')">
                            {{ $lang['by_size'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $selection === 'distance' ? 'tagsUnit' : '' }}" @click="$wire.set('selection', 'distance')">
                            {{ $lang['by_distance'] }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4 mt-4">
                    {{-- Resolution --}}
                    <div class="space-y-2 relative">
                        <label for="resolution" class="label">{{ $lang['resolution'] }}</label>
                        <select wire:model.live="resolution" id="resolution" class="input">
                            <option value="480p">480p</option>
                            <option value="720p">720p</option>
                            <option value="1080p">1080p</option>
                            <option value="ultra_hd">Ultra HD</option>
                            <option value="4k">4k</option>
                            <option value="8k">8k</option>
                        </select>
                    </div>

                    @if ($selection === 'size')
                        {{-- Screen Size --}}
                        <div class="space-y-2">
                            <label for="size" class="font-s-14 text-blue">{{ $lang['screen_size'] }}:</label>
                            <div class="relative w-full">
                                <input type="number" wire:model.live.debounce.500ms="size" id="size" step="any" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['size_unit'] = !dropdowns['size_unit']">
                                    {{ $size_unit }} ▾
                                </label>
                                <div x-show="dropdowns['size_unit']" @click.away="dropdowns['size_unit'] = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl" x-cloak>
                                    @foreach (["cm","m",'in','ft'] as $item)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('size_unit', '{{ $item }}'); dropdowns['size_unit'] = false">{{ $item }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Viewing Distance --}}
                        <div class="space-y-2 mt-2">
                            <label for="distance" class="font-s-14 text-blue">{{ $lang['v_distance'] }}:</label>
                            <div class="relative w-full">
                                <input type="number" wire:model.live.debounce.500ms="distance" id="distance" step="any" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['distance_unit'] = !dropdowns['distance_unit']">
                                    {{ $distance_unit }} ▾
                                </label>
                                <div x-show="dropdowns['distance_unit']" @click.away="dropdowns['distance_unit'] = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl" x-cloak>
                                    @foreach (["cm","m",'in','ft'] as $item)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('distance_unit', '{{ $item }}'); dropdowns['distance_unit'] = false">{{ $item }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Viewing Angle --}}
                    <div class="space-y-2">
                        <label for="angle" class="font-s-14 text-blue">{{ $lang['v_angle'] }}:</label>
                        <div class="relative w-full">
                            <input type="number" wire:model.live.debounce.500ms="angle" id="angle" step="any" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['angle_unit'] = !dropdowns['angle_unit']">
                                {{ $angle_unit }} ▾
                            </label>
                            <div x-show="dropdowns['angle_unit']" @click.away="dropdowns['angle_unit'] = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl" x-cloak>
                                @foreach (["deg","red"] as $item)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('angle_unit', '{{ $item }}'); dropdowns['angle_unit'] = false">{{ $item }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
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
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full bg-light-blue p-3 rounded-lg">
                            <div class="flex flex-wrap">
                                <div class="lg:w-2/3 w-full text-lg">
                                    @php
                                        $names = [$lang['s_size'], $lang['s_width'], $lang['s_height'], $lang['od'], $lang['md']];
                                    @endphp
                                    @foreach($detail['units_cm'] as $key => $unit)
                                        @if(!empty($detail['ans'][$key]))
                                            @php
                                                $ans_unit = ($key === 3 || $key === 4) ? 'ft' : 'in';
                                            @endphp
                                            <table class="w-full mb-4">
                                                <tr>
                                                    <td class="w-7/10 border-b py-2 font-semibold">{{ $names[$key] }} :</td>
                                                    <td class="border-b py-2">{{ $detail['ans'][$key] }} {{ $ans_unit }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">centimeter :</td>
                                                    <td class="border-b py-2">{{ $unit }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">meter :</td>
                                                    <td class="border-b py-2">{{ $detail['units_m'][$key] }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">inches :</td>
                                                    <td class="border-b py-2">{{ $detail['units_in'][$key] }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">feet :</td>
                                                    <td class="border-b py-2">{{ $detail['units_ft'][$key] }}</td>
                                                </tr>
                                            </table>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
