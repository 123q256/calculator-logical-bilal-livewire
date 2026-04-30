<div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
        <div class="col-12 col-lg-9 mx-auto mt-2  w-full">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover:bg-blue-600 hover:text-white {{ $calculation_type === 'whpToHp' ? 'bg-blue-600 text-white shadow-md' : 'bg-white text-blue-600' }}" 
                         wire:click="$set('calculation_type', 'whpToHp')">
                        WHP to HP
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover:bg-blue-600 hover:text-white {{ $calculation_type === 'hpToWhp' ? 'bg-blue-600 text-white shadow-md' : 'bg-white text-blue-600' }}" 
                         wire:click="$set('calculation_type', 'hpToWhp')">
                        HP to WHP
                    </div>
                </div>
            </div>
        </div>
            <div class="grid grid-cols-12 mt-5  gap-4">
                
                @if($calculation_type === 'whpToHp')
                <div class="col-span-12">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <label for="whp" class="font-s-14 text-blue">{{ $lang[1] }} (WHP):</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" wire:model.live="whp" id="whp" class="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-12">
                            <label for="dt" class="font-s-14 text-blue">{{ $lang['2'] }} (DL):</label>
                            <div class="w-100 py-2 position-relative">
                                <select wire:model.live="dt" id="dt" class="input">
                                    <option value=".10">{{ $lang[3] }} (10%)</option>
                                    <option value=".15">{{ $lang[4] }} (15%)</option>
                                    <option value=".25">{{ $lang[5] }} (25%)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($calculation_type === 'hpToWhp')
                <div class="col-span-12">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <label for="ehp" class="font-s-14 text-blue">{{ $lang[6] }} (HP):</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" wire:model.live="ehp" id="ehp" class="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-12">
                            <label for="dtlf" class="font-s-14 text-blue">{{ $lang['2'] }} (DTLF):</label>
                            <div class="w-100 py-2 position-relative">
                                <select wire:model.live="dtlf" id="dtlf" class="input">
                                    <option value="1.1">{{ $lang[3] }} (1.1)</option>
                                    <option value="1.15">{{ $lang[4] }} (1.15)</option>
                                    <option value="1.2">{{ $lang[5] }} (1.2)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
         @if ($type == 'calculator')
         @include('inc.button')
        @endif
        @if ($type=='widget')
        @include('inc.widget-button')
         @endif
     </div>
     <hr>
    @isset($detail)
    
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        @if ($detail['submit'] === 'whpToHp')    
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['6']}} (HP)</strong></p>
                                <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] p-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ $detail['hp'] }}</strong>
                                </p>
                            </div>
                        </div>
                            <div class="solution-steps mt-4 space-y-2 text-[18px]">
                                <p class="font-semibold">Steps:</p>
                                <p>Wheel Horsepower (WHP) = {{ $whp }}</p>
                                <p>Drivetrain Loss (DL) = {{ (float)$dt * 100 }}%</p>
                                <p class="font-semibold mt-4">Formula:</p>
                                <p>HP = WHP * 1 / (1 – DL )</p>
                                <p>HP = {{ $whp }} * 1 / (1 – {{ $dt }} )</p>
                                <p>HP = {{ $detail['hp'] }}</p>
                            </div>
                        @else
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['8']}} (WHP)</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[25px] bg-[#2845F5] p-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ $detail['whp'] }}</strong>
                                </p>
                            </div>
                        </div>
                            <div class="solution-steps mt-4 space-y-2 text-[18px]">
                                <p class="font-semibold">Steps:</p>
                                <p>Engine Horsepower (HP) = {{ $ehp }}</p>
                                <p>Drivetrain Loss Factor (DTLF) = {{ $dtlf }}</p>
                                <p class="font-semibold mt-4">Formula:</p>
                                <p>WHP = HP / DTLF</p>
                                <p>WHP = {{ $ehp }} / {{ $dtlf }}</p>
                                <p>WHP = {{ $detail['whp'] }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
</div>

