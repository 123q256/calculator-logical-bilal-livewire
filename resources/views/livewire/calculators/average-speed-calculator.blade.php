<div>
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
         <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="flex flex-wrap ">
                <label for="dob" class="label">{{$lang[1]}}:</label>
                <div class="w-full flex space-x-4">
                    <div class="w-full px-2">
                        <label for="t_hours" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="t_hours" min="0" id="t_hours" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="w-full px-2">
                        <label for="t_min" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" min="0" wire:model.live="t_min" id="t_min" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="w-full px-2">
                        <label for="t_sec" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" min="0" wire:model.live="t_sec" id="t_sec" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                </div>
                <label for="e_date" class="label">{{$lang[5]}}:</label>
                <div class="w-full flex space-x-4">
                    <div class="w-full px-2">
                        <div class="space-y-2">
                            <label for="distance" class="font-s-14 text-blue">{{ $lang['6'] }}</label>
                            <div class="relative w-full ">
                                <input type="number" wire:model.live="distance" id="distance" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00"/>
                                <label for="distance_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="$toggle('unit_open')">{{ $distance_unit }} ▾</label>
                                @if($unit_open)
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('km')">km</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('{{ $lang[7] }}')">{{ $lang[7] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('{{ $lang[8] }}')">{{ $lang[8] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('{{ $lang[9] }}')">{{ $lang[9] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('{{ $lang[10] }}')">{{ $lang[10] }}</p>
                                </div>
                                @endif
                            </div>
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
    <hr>
    @isset($detail)
        {{-- result --}}
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full bg-light-blue  p-3 rounded-lg mt-3">
                    <div class="lg:w-[90%] md:w-[90%]  w-full overflow-auto  mt-2">
                        <p class="mt-4">{{ $lang[11] }}</p>
                        <table class="w-full text-lg">
                            <tr>
                                <td class="py-2 border-b w-7/12"><strong>{{ $lang[12] }}</strong></td>
                                <td class="py-2 border-b">{{ round($detail['ans_mps'], 2) }} m/s</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-7/12"><strong>{{ $lang[13] }}</strong></td>
                                <td class="py-2 border-b">{{ round($detail['ans_mph'], 2) }} mph</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-7/12"><strong>{{ $lang[14] }}</strong></td>
                                <td class="py-2 border-b">{{ round($detail['ans_kmh'], 2) }} km/h</td>
                            </tr>
                        </table>
                        <p class="mt-4">{{ $lang[15] }}</p>
                        <table class="w-full text-lg">
                            <tr>
                                <td class="py-2 border-b w-7/12"><strong>{{ $lang[15] }}</strong></td>
                                <td class="py-2 border-b">{{ round($detail['ans_mphh'], 2) }} m/h</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-7/12"><strong>{{ $lang[16] }}</strong></td>
                                <td class="py-2 border-b">{{ round($detail['ans_ydph'], 2) }} yd/h</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-7/12"><strong>{{ $lang[17] }}</strong></td>
                                <td class="py-2 border-b">{{ round($detail['ans_ftph'], 2) }} ft/h</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    @endisset
</form>
</div>
