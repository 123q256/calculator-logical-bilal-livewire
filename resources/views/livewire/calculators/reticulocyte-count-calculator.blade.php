<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="w-full lg:w-7/12 mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-5">
                    {{-- Reticulocytes (%) --}}
                    <div class="px-2 lg:pr-4">
                        <label for="x" class="label">{!! $lang['x'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="x" id="x" class="input w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Norm: 0.5 - 2.5" />
                            <span class="absolute right-3 top-1/2 transform -translate-y-1/2">%</span>
                        </div>
                    </div>

                    {{-- Patient's Hematocrit (%) --}}
                    <div class="px-2 lg:pr-4">
                        <label for="y" class="label">{!! $lang['y'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="y" id="y" class="input w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Norm: 36 - 51" />
                            <span class="absolute right-3 top-1/2 transform -translate-y-1/2">%</span>
                        </div>
                    </div>

                    {{-- Normal Hematocrit (%) --}}
                    <div class="px-2 lg:pr-4">
                        <label for="z" class="label">{!! $lang['z'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="z" id="z" class="input w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Norm: 36 - 51" />
                            <span class="absolute right-3 top-1/2 transform -translate-y-1/2">%</span>
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

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full rounded-lg mt-3">
                            <div class="w-full lg:w-9/12 flex flex-col md:flex-row justify-between">
                                <div>
                                    <p class="text-lg">{{ $lang['ans'] }}</p>
                                    <p class="text-4xl">
                                        <strong class="text-green-600">
                                            {{ isset($detail['x']) ? number_format($detail['x'], 2) : '0.0' }}
                                        </strong>
                                    </p>
                                </div>
                                <div class="border-r-2 pr-3 mr-3 hidden md:block"></div>
                                <div>
                                    <p class="text-lg">{{ $lang['ans1'] }}</p>
                                    <p class="text-4xl">
                                        <strong class="text-green-600">
                                            {{ isset($detail['y']) ? number_format($detail['y'], 3) : '0.0' }}
                                        </strong>
                                    </p>
                                </div>
                            </div>
                            <p class="text-xl mt-4">
                                <strong class="text-[#3E9960]">
                                    {{ $detail['ans'] ?? 'Adequate / Hypoproliferation' }}
                                </strong>
                            </p>
                            <p class="mt-2">
                                <strong>
                                    {{ $detail['ans_p'] ?? 'Reticulocyte index ≥2 / <2 indicates Adequate / Hypoproliferation response' }}
                                </strong>
                            </p>


                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
