<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <div class="grid grid-cols-12 mt-3 gap-4">
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="grid grid-cols-1 mt-3 gap-4">
                                    {{-- Bed Type --}}
                                    <div class="col-span-12">
                                        <label for="bed" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                                        <div class="w-100 py-2">
                                            <select wire:model.live="bed" id="bed" class="input">
                                                <option value="grid">{{ $lang['2'] }}</option>
                                                <option value="hedgerow">{{ $lang['3'] }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Grid Type (Only for Grid Bed) --}}
                                    @if($bed === 'grid')
                                        <div class="col-span-12">
                                            <label for="grid" class="font-s-14 text-blue grid_text">{{ $lang['4'] }}:</label>
                                            <div class="w-100 py-2">
                                                <select wire:model.live="grid" id="grid" class="input">
                                                    <option value="square">{{ $lang['5'] }}</option>
                                                    <option value="rectangular">{{ $lang['6'] }}</option>
                                                    <option value="triangular">{{ $lang['7'] }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Hedgerows (Only for Hedgerow Bed) --}}
                                    @if($bed === 'hedgerow')
                                        <div class="col-span-12">
                                            <label for="hedgerows" class="font-s-14 text-blue hedgerows_text">{{ $lang['8'] }}:</label>
                                            <div class="w-100 py-2">
                                                <select wire:model.live="hedgerows" id="hedgerows" class="input">
                                                    @for($i=1; $i<=5; $i++)
                                                        <option value="{{ $i }}">{{ $lang[8+$i] }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6 flex items-center justify-center">
                                @php
                                    $imgName = 'square.png';
                                    if ($bed === 'grid') {
                                        if ($grid === 'rectangular') $imgName = 'rectangle.png';
                                        elseif ($grid === 'triangular') $imgName = 'triangle.png';
                                    } else {
                                        $imgs = ['1' => 'single.png', '2' => 'double.png', '3' => 'triple.png', '4' => 'four.png', '5' => 'five.png'];
                                        $imgName = $imgs[$hedgerows] ?? 'single.png';
                                    }
                                @endphp
                                <img src="{{ asset('images/plant-spacing-img/' . $imgName) }}" alt="ShapeImage" class="max-width my-lg-2 set_img" style="max-width: 300px; height: auto;">
                            </div>
                        </div>
                    </div>

                    {{-- Dimensions --}}
                    @if($bed === 'grid')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="length" class="font-s-14 text-blue">{{ $lang['14'] }}:</label>
                            <div class="grid grid-cols-12 mt-[7px] gap-2">
                                <div class="col-span-8">
                                    <input type="number" step="any" wire:model.live="length" id="length" class="input" />
                                </div>
                                <div class="col-span-4">
                                    <select wire:model.live="length_unit" class="input">
                                        @foreach (["cm","m","in","ft","yd","mm","km","mi"] as $u)
                                            <option value="{{ $u }}">{{ $u }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="width" class="font-s-14 text-blue">{{ $lang['15'] }}:</label>
                            <div class="grid grid-cols-12 mt-[7px] gap-2">
                                <div class="col-span-8">
                                    <input type="number" step="any" wire:model.live="width" id="width" class="input" />
                                </div>
                                <div class="col-span-4">
                                    <select wire:model.live="width_unit" class="input">
                                        @foreach (["cm","m","in","ft","yd","mm","km","mi"] as $u)
                                            <option value="{{ $u }}">{{ $u }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="border" class="font-s-14 text-blue">{{ $lang['19'] }}:</label>
                            <div class="grid grid-cols-12 mt-[7px] gap-2">
                                <div class="col-span-8">
                                    <input type="number" step="any" wire:model.live="border" id="border" class="input" />
                                </div>
                                <div class="col-span-4">
                                    <select wire:model.live="border_unit" class="input">
                                        @foreach (["cm","m","in","ft","yd","mm","km","mi"] as $u)
                                            <option value="{{ $u }}">{{ $u }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="hedge" class="font-s-14 text-blue">{{ $lang['20'] }}:</label>
                            <div class="grid grid-cols-12 mt-[7px] gap-2">
                                <div class="col-span-8">
                                    <input type="number" step="any" wire:model.live="hedge" id="hedge" class="input" />
                                </div>
                                <div class="col-span-4">
                                    <select wire:model.live="hedge_unit" class="input">
                                        @foreach (["cm","m","in","ft","yd","mm","km","mi"] as $u)
                                            <option value="{{ $u }}">{{ $u }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Mode Selection (Want) --}}
                    @if($bed === 'hedgerow' || ($bed === 'grid' && $grid === 'rectangular'))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="want" class="font-s-14 text-blue">{{ $lang['16'] }}:</label>
                            <div class="w-100 py-2">
                                <select wire:model.live="want" id="want" class="input">
                                    <option value="amount">{{ $lang['17'] }}</option>
                                    <option value="arrange">{{ $lang['18'] }}</option>
                                </select>
                            </div>
                        </div>
                    @endif

                    {{-- Conditional Inputs based on Mode (Want) --}}
                    @if(($bed === 'grid' && $grid === 'square') || ($bed === 'grid' && $grid === 'triangular') || ($bed === 'grid' && $grid === 'rectangular' && $want === 'amount') || ($bed === 'hedgerow' && $want === 'amount'))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="plant_spacing" class="font-s-14 text-blue">{{ $lang['21'] }}:</label>
                            <div class="grid grid-cols-12 mt-[7px] gap-2">
                                <div class="col-span-8">
                                    <input type="number" step="any" wire:model.live="plant_spacing" id="plant_spacing" class="input" />
                                </div>
                                <div class="col-span-4">
                                    <select wire:model.live="plant_spacing_unit" class="input">
                                        @foreach (["cm","m","in","ft","yd","mm","km","mi"] as $u)
                                            <option value="{{ $u }}">{{ $u }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($bed === 'grid' && $grid === 'rectangular' && $want === 'amount')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="row_spacing" class="font-s-14 text-blue">{{ $lang['22'] }}:</label>
                            <div class="grid grid-cols-12 mt-[7px] gap-2">
                                <div class="col-span-8">
                                    <input type="number" step="any" wire:model.live="row_spacing" id="row_spacing" class="input" />
                                </div>
                                <div class="col-span-4">
                                    <select wire:model.live="row_spacing_unit" class="input">
                                        @foreach (["cm","m","in","ft","yd","mm","km","mi"] as $u)
                                            <option value="{{ $u }}">{{ $u }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(($bed === 'grid' && $grid === 'rectangular' && $want === 'arrange') || ($bed === 'hedgerow' && $want === 'arrange'))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="total_plants" class="font-s-14 text-blue">{{ $lang['23'] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="total_plants" id="total_plants" class="input" />
                            </div>
                        </div>
                        @if($bed === 'grid')
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="total_rows" class="font-s-14 text-blue">{{ $lang['24'] }}:</label>
                                <div class="w-100 py-2">
                                    <input type="number" step="any" wire:model.live="total_rows" id="total_rows" class="input" />
                                </div>
                            </div>
                        @endif
                    @endif

                    <p class="col-span-12 mt-4 font-semibold border-t pt-4">{{ $lang['39'] }}</p>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="no_of_plant" class="font-s-14 text-blue">{{ $lang['40'] }}:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="no_of_plant" id="no_of_plant" class="input" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="plant_price" class="font-s-14 text-blue">{{ $lang['41'] }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="plant_price" id="plant_price" class="input pr-10" />
                            <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-blue font-semibold">{{ $currancy }}</span>
                        </div>
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
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full space-y-4">
                                @if($bed === 'grid')
                                    @if($grid === 'square')
                                        <div class="border-b py-3 text-[18px] ">
                                            <strong>{{ $lang[25] }}:</strong>
                                            <span>{{ $detail['plants'] }}</span>
                                        </div>
                                        <p class="text-gray-600 italic">
                                            {{ $lang[28] }} {{ $detail['plant_cols'] }} x {{ $detail['plant_rows'] }} {{ $lang[29] }}
                                        </p>
                                    @elseif($grid === 'rectangular')
                                        @if($want === 'amount')
                                            <div class="border-b py-3 text-[18px] ">
                                                <strong>{{ $lang[25] }}:</strong>
                                                <span>{{ $detail['plants'] }}</span>
                                            </div>
                                            <p class="text-gray-600 italic">
                                                {{ $lang[30] }} {{ $detail['plant_cols'] }} x {{ $detail['plant_rows'] }} {{ $lang[31] }}
                                            </p>
                                        @else
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="border-b py-2 text-[18px] ">
                                                    <strong>{{ $lang[26] }}:</strong>
                                                    <span>{{ $detail['cols'] }}</span>
                                                </div>
                                                <div class="border-b py-2 text-[18px] ">
                                                    <strong>{{ $lang[32] }}:</strong>
                                                    <span>{{ $detail['row_space'] }} m</span>
                                                </div>
                                                <div class="border-b py-2 text-[18px] ">
                                                    <strong>{{ $lang[27] }}:</strong>
                                                    <span>{{ $detail['plant_spacing'] }} m</span>
                                                </div>
                                            </div>
                                        @endif
                                    @elseif($grid === 'triangular')
                                        <div class="border-b py-3 text-[18px] ">
                                            <strong>{{ $lang[25] }}:</strong>
                                            <span>{{ $detail['total_plants'] }}</span>
                                        </div>
                                        <p class="text-gray-600 italic">
                                            {{ $lang[33] }} {{ $detail['total_rows'] }} {{ $lang[34] }} {{ $detail['row_spacing'] }} m {{ $lang[35] }} {{ $detail['plant_spacing_m'] }} m {{ $lang[36] }} {{ $detail['odd_num_plant'] }} {{ $lang[37] }} {{ $detail['evn_num_plant'] }} {{ $lang[38] }}
                                        </p>
                                    @endif
                                @else
                                    @if($want === 'amount')
                                        <div class="border-b py-3 text-[18px] ">
                                            <strong>{{ $lang[25] }}:</strong>
                                            <span>{{ $detail['total_plants'] }}</span>
                                        </div>
                                    @else
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="border-b py-2 text-[18px] ">
                                                <strong>{{ $lang[26] }}:</strong>
                                                <span>{{ $detail['plant_per_row'] }}</span>
                                            </div>
                                            <div class="border-b py-2 text-[18px] ">
                                                <strong>{{ $lang[27] }}:</strong>
                                                <span>{{ number_format($detail['plant_space'] ?? 0, 4) }} m</span>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                <div class="border-t-2 border-dashed pt-4 mt-4 mr-5  items-center text-xl text-blue font-bold">
                                    <span>{{ $lang[42] }}:</span>
                                    <span>{{ $currancy }} {{ number_format($detail['total_plant_cost'] ?? 0, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
