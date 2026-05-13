<div>
      <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
         @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

        <div class="lg:w-[70%] w-full mx-auto space-y-6">
            <div class="grid grid-cols-12 gap-x-8 gap-y-6">
                <div class="col-span-12 mb-2">
                    <p><strong class="text-[#2845F5] text-lg">Convert Macronutrient from Grams to Calories!</strong></p>
                </div>

                {{-- Carbohydrate --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                    <label class="text-[15px] font-medium text-gray-700 mb-2 block">{{ $lang['1'] }}:</label>
                    <div class="relative">
                        <input type="number" wire:model.live="carbohydrate" class="border border-blue-400 p-1 rounded-xl focus:ring-2 w-full text-xs h-10 px-3 pr-16" placeholder="00">
                        <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20" @click="open = !open">{{ $carbo_unit }} ▾</label>
                        
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg overflow-hidden">
                            <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('carbo_unit', 'g')" @click="open = false">grams (g)</p>
                            <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('carbo_unit', 'dag')" @click="open = false">decagrams (dag)</p>
                            <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('carbo_unit', 'oz')" @click="open = false">ounces (oz)</p>
                        </div>
                    </div>
                </div>

                {{-- Protein --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                    <label class="text-[15px] font-medium text-gray-700 mb-2 block">{{ $lang['2'] }}:</label>
                    <div class="relative">
                        <input type="number" wire:model.live="protein" class="border border-blue-400 p-1 rounded-xl focus:ring-2  w-full text-xs h-10 px-3 pr-16" placeholder="00">
                        <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20" @click="open = !open">{{ $protein_unit }} ▾</label>
                        
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg overflow-hidden">
                            <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('protein_unit', 'g')" @click="open = false">grams (g)</p>
                            <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('protein_unit', 'dag')" @click="open = false">decagrams (dag)</p>
                            <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('protein_unit', 'oz')" @click="open = false">ounces (oz)</p>
                        </div>
                    </div>
                </div>

                {{-- Fat --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                    <label class="text-[15px] font-medium text-gray-700 mb-2 block">{{ $lang['3'] }}:</label>
                    <div class="relative">
                        <input type="number" wire:model.live="fat" class="border border-blue-400 p-1 rounded-xl focus:ring-2  w-full text-xs h-10 px-3 pr-16" placeholder="00">
                        <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20" @click="open = !open">{{ $fat_unit }} ▾</label>
                        
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg overflow-hidden">
                            <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('fat_unit', 'g')" @click="open = false">grams (g)</p>
                            <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('fat_unit', 'dag')" @click="open = false">decagrams (dag)</p>
                            <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('fat_unit', 'oz')" @click="open = false">ounces (oz)</p>
                        </div>
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

    @if ($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-[10px] p-3" style="border: 1px solid #c1b8b899;">
                                        <span>{{ $lang['4'] }} =</span>
                                        <strong class="text-green-700 font-s-25">{{ round($detail['carbs'],3) }}</strong>
                                        <strong>(kcal)</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-[10px] p-3" style="border: 1px solid #c1b8b899;">
                                        <span>{{ $lang['5'] }} =</span>
                                        <strong class="text-green-700 font-s-25">{{ round($detail['pr'],3) }}</strong>
                                        <strong>(kcal)</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-[10px] p-3" style="border: 1px solid #c1b8b899;">
                                        <span>{{ $lang['6'] }} =</span>
                                        <strong class="text-green-700 font-s-25">{{ round($detail['cf'],3) }}</strong>
                                        <strong>(kcal)</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-[10px] p-3" style="border: 1px solid #c1b8b899;">
                                        <span>{{ $lang['7'] }} =</span>
                                        <strong class="text-green-700 font-s-25">{{ round($detail['tc'],3) }}</strong>
                                        <strong>(kcal)</strong>
                                    </div>
                                </div>
                            </div>
                            <p class="text-[18px] px-3 mb-lg-1 my-4"><strong class="text-blue-700">{{ $lang['8'] }} :</strong></p>
                            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12 md:col-span-3 lg:col-span-3">
                                    <p><strong class="text-blue-700">1- {{ $lang['9'] }}</strong></p>
                                    <p>= 4 <span class="text-[16px]"><strong>(kcal)</strong></span> * ({{ $detail['cv'] }})</p>
                                    <p>= <strong class="text-green-700">{{ $detail['carbs'] }}</strong><span class="text-[16px]"><strong> (kcal)</strong></span></p>
                                </div>
                                <div class="col-span-1 border-r pe-3 hidden md:block lg:block"></div>
                                <div class="col-span-12 md:col-span-3 lg:col-span-3">
                                    <p><strong class="text-blue-700">2- {{ $lang['10'] }}</strong></p>
                                    <p>= 4 <span class="text-[16px]"><strong>(kcal)</strong></span> * ({{ $detail['pv'] }})</p>
                                    <p>= <strong class="text-green-700">{{ $detail['pr'] }}</strong><span class="text-[16px]"><strong> (kcal)</strong></span></p>
                                </div>
                                <div class="col-span-1 border-r pe-3 hidden md:block lg:block"></div>
                                <div class="col-span-12 md:col-span-3 lg:col-span-3">
                                    <p><strong class="text-blue-700">3- {{ $lang['11'] }}</strong></p>
                                    <p>= 9 <span class="text-[16px]"><strong>(kcal)</strong></span> * ({{ $detail['fv'] }})</p>
                                    <p>= <strong class="text-green-700">{{ $detail['cf'] }}</strong><span class="text-[16px]"><strong> (kcal)</strong></span></p>
                                </div>
                            </div>
                            <div class="w-full mt-3">
                                <p><strong class="text-blue-700">4- {{ $lang['12'] }}</strong></p>
                                <p>= {{ $lang['9'] }} + {{ $lang['10'] }} + {{ $lang['11'] }} </p>
                                <p>= ({{ $detail['carbs'] }} <span class="black-text text-[16px]"><strong>kcal</strong></span>) + ({{ $detail['pr'] }} <span class="black-text text-[16px]"><strong>kcal</strong></span>) + ({{ $detail['cf'] }} <span class="black-text text-[16px]"><strong>kcal</strong></span>)</p>
                                <p class=" dk">= <strong class="text-green-700">{{ $detail['tc'] }}</strong><span class="text-[16px]"><strong> (kcal)</strong></span></p>
                            </div>
                            <div class="w-full mt-3">
                                <span>Related Calculators : </span>
                                <span><a class="text-blue-700 text-decoration-none underline" href="{{ url('calorie-calculator') }}/" title='Sine Calculator' target='_blank' rel='noopener'>Calorie Calculator</a></span>,
                                <span><a class="text-blue-700 text-decoration-none underline" href="{{ url('calorie-deficit-calculator') }}/" title='ArcSine Calculator' target='_blank' rel='noopener'>Calorie Deficit Calculator</a></span>,
                                <span><a class="text-blue-700 text-decoration-none underline" href="{{ url('steps-to-calories-calculator') }}/" title='Cosecant Calculator' target='_blank' rel='noopener'>Steps to Calories Calculator</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </form>
</div>
