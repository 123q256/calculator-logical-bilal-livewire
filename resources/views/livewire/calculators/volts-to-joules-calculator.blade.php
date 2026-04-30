<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="Solve_unit" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2">
                        <select wire:model.live="Solve_unit" id="Solve_unit" class="input">
                            <option value="Joules">{{ $lang['2'] }}</option>
                            <option value="Volts">{{ $lang['3'] }}</option>
                            <option value="Coulombs">{{ $lang['4'] }}</option>
                        </select>
                    </div>
                </div>

                @if($Solve_unit !== 'Volts')
                <div class="col-span-12">
                    <label for="volts" class="font-s-14 text-blue">{{ $lang[5] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model="volts" id="volts" class="input" placeholder="00" />
                    </div>
                </div>
                @endif

                @if($Solve_unit !== 'Coulombs')
                <div class="col-span-12">
                    <label for="coulombs" class="font-s-14 text-blue">{{ $lang[6] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model="coulombs" id="coulombs" class="input" placeholder="00" />
                    </div>
                </div>
                @endif

                @if($Solve_unit !== 'Joules')
                <div class="col-span-12">
                    <label for="joules" class="font-s-14 text-blue">{{ $lang[7] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model="joules" id="joules" class="input" placeholder="00" />
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
    @if(isset($detail))
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="text-center">
                            <p class="text-[18px]"><strong>{{ $Solve_unit }}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong>{{ round($detail['answer'], 7) }}</strong>
                                </p>
                            </div>
                        </div>
                        <div class="w-full mt-3 space-y-2">
                            <p class="text-[18px]"><strong>{{ $lang[8] }}</strong></p>
                            @if($Solve_unit == "Joules")
                                <p>{{ $lang[9] }}</p>
                                <p>{{ $lang[10] }}.</p>
                                <p>{{ $lang[7] }} = {{ $lang[5] }} ∗ {{ $lang[6] }}</p>
                                <p>{{ $lang[7] }} = {{ $volts }} ∗ {{ $coulombs }}</p>
                                <p>{{ $lang[7] }} = {{ round($detail['answer'], 7) }} J</p>
                            @elseif($Solve_unit == "Volts")
                                <p>{{ $lang[11] }}</p>
                                <p>{{ $lang[12] }}.</p>
                                <p>{{ $lang[5] }} = {{ $lang[7] }} / {{ $lang[6] }}</p>
                                <p>{{ $lang[5] }} = {{ $joules }} / {{ $coulombs }}</p>
                                <p>{{ $lang[5] }} = {{ round($detail['answer'], 7) }} V</p>
                            @elseif($Solve_unit == "Coulombs")
                                <p>{{ $lang[13] }}</p>
                                <p>{{ $lang[14] }}.</p>
                                <p>{{ $lang[6] }} = {{ $lang[7] }} / {{ $lang[5] }}</p>
                                <p>{{ $lang[6] }} = {{ $joules }} / {{ $volts }}</p>
                                <p>{{ $lang[6] }} = {{ round($detail['answer'], 7) }} C</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</form>
</div>
