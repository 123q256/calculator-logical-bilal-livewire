<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[85%] md:w-[85%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="serving" class="label">{!! $lang['1'] !!}:</label>
                <div class="w-full py-2 relative">
                    <select wire:model.live="serving" id="serving" class="input">
                        <option value="per 100 g">{{ $lang['2'] }}</option>
                        <option value="per serving">{{ $lang['3'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="location" class="label">{!! $lang['4'] !!}:</label>
                <div class="w-full py-2 relative">
                    <select wire:model.live="location" id="location" class="input">
                        <option value="yes">{{ $lang['5'] }}</option>
                        <option value="no">{{ $lang['6'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="carbohydrates" class="label">{!! $lang['7'] !!}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" wire:model.live="carbohydrates" id="carbohydrates" class="input" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="fiber" class="label">{!! $lang['8'] !!}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" wire:model.live="fiber" id="fiber" class="input" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="alcohol" class="label">{!! $lang['9'] !!}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" wire:model.live="alcohol" id="alcohol" class="input" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-12"><strong class="text-blue-500 text-[18px]">{{ $lang['10'] }}</strong></div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="contains" class="label">{!! $lang['11'] !!}:</label>
                <div class="w-full py-2 relative">
                    <select wire:model.live="contains" id="contains" class="input">
                        <option value="yes">{{ $lang['5'] }}</option>
                        <option value="no">{{ $lang['6'] }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
     @if ($type == 'calculator')
     @include('inc.button')
    @endif
    @if ($type=='widget')
    @include('inc.widget-button')
     @endif
 </div>

    @isset($detail)
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                    <strong>{!! ($serving == 'per serving') ? "Servings consumed = <span class='text-green-500 text-[28px]'>1</span>" : "Weight of your product = <span class='text-green-500 text-[28px]'>100</span>" !!}</strong>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                    <strong>{{ $lang['13'] }} =</strong>
                                    <strong class="text-green-500 text-[28px]">{{ $detail['Net_carbs'] }}</strong>
                                    <span>g</span>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                    <strong>{{ $lang['14'] }} =</strong>
                                    <strong class="text-green-500 text-[28px]">{{ $detail['Net_carbs'] * 4 }}</strong>
                                    <span>kcal</span>
                                </div>
                            </div>
                        </div>
                        <!-- ----------------------------------- inputs --------------------------------- -->
                        @php $serving_text = ($serving == 'per serving') ? 'serving' : '100g' @endphp
                        <p class="font-s-18 mt-2"><strong>{{ $lang['15'] }}</strong></p>
                        <p class="mt-1">{{ $lang['7'] }} : {{ $detail['carbohydrates'] }} g per {{ $serving_text }}</p>
                        <p class="mt-1">{{ $lang['8'] }} : {{ $detail['fiber'] }} g per {{ $serving_text }}</p>
                        <p class="mt-1">{{ $lang['9'] }} : {{ $detail['alcohol'] }} g per {{ $serving_text }}</p>
                        <!-- -------------------------- Solution ----------------------- -->
                        <p class="font-s-18 mt-3"><strong>{{ $lang['16'] }}</strong></p>
                        <p class="mt-1">{{ $lang['17'] }}</p>
                        <p class="mt-1">{{ $lang['18'] }} = 
                            <span>Total carbohydrate - Fiber -</span>
                            <span class="fraction">
                                <span class="num">(Sugar alcohol)</span>
                                <span class="visually-hidden"></span>
                                <span class="den">2</span>
                            </span>
                        </p>
                        <p class="mt-1">{{ $lang['18'] }} = 
                            <span>{{ $detail['carbohydrates'] }} - {{ $detail['fiber'] }} -</span>
                            <span class="fraction">
                                <span class="num">({{ $detail['alcohol'] }})</span>
                                <span class="visually-hidden"></span>
                                <span class="den">2</span>
                            </span>
                        </p>
                        <p class="mt-1">{{ $lang['18'] }} = {{ $detail['Net_carbs'] }} g</p>
                        <p class="mt-1">{{ $lang['19'] }} = {{ $detail['Net_carbs'] * 4 }} kcal</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
</div>
