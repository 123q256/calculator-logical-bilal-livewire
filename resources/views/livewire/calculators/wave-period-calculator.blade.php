<div>
 <style>
    .velocitytab .v_active {
        border-bottom: 3px solid var(--light-blue);
    }
 </style>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  mt-3  gap-4">
                <div class="flex justify-center mb-2">
                    <div class="flex flex-row items-center bg-[#E8F7F2] border border-[#2ECC71] rounded-xl p-1.5 gap-2">
                        <p wire:click="setTab('simple')" class="px-6 py-2.5 cursor-pointer rounded-lg font-bold transition-all duration-300 {{ $sim_adv == 'simple' ? 'bg-[#2845F5] text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                            {{ $lang['1'] }}
                        </p>
                        <p wire:click="setTab('advance')" class="px-6 py-2.5 cursor-pointer rounded-lg font-bold transition-all duration-300 {{ $sim_adv == 'advance' ? 'bg-[#2845F5] text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                            {{ $lang['2'] }}
                        </p>
                    </div>
                </div>

                @if($sim_adv == 'simple')
                <div class="simple">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-1 md:col-span-2">
                            <label for="frequency" class="font-s-14 text-blue">{{$lang['3']}} (Hz):</label>
                            <div class="w-full py-2">                                  
                                <input type="number" step="any" wire:model="frequency" id="frequency" class="input" placeholder="00"/>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($sim_adv == 'advance')
                <div class="advance">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <label for="wavelength" class="font-s-14 text-blue">{{$lang['4']}} (m):</label>
                            <div class="w-full py-2">                                  
                                <input type="number" step="any" wire:model="wavelength" id="wavelength" class="input" placeholder="00"/>
                            </div>
                        </div> 
                        <div class="col-span-1">
                            <label for="wave_speed" class="font-s-14 text-blue">{{$lang['5']}} (m/s):</label>
                            <div class="w-full py-2">                                  
                                <input type="number" step="any" wire:model="wave_speed" id="wave_speed" class="input" placeholder="00"/>
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

    @isset($detail)
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="row my-2">
                        @if($detail['sim_adv'] == 'simple')
                            <div class="w-full md:w-[100%] lg:w-[100%] overflow-auto  text-[18px]">
                                <table class="w-full">
                                    <tr class="col">
                                        <td class="border-b py-2"><strong>{{$lang['wave']}} :</strong></td>
                                        <td class="border-b py-2"> {{$detail['wavePeriod']}} {{$lang['sec']}}</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @if($detail['sim_adv'] == 'advance')
                            <div class="w-full md:w-[100%] lg:w-[100%] overflow-auto  text-[18px]">
                                <table class="w-full">
                                    <tr>
                                        <td width="60%" class="border-b py-2"><strong>{{$lang['wave']}} :</strong></td> 
                                        <td class="border-b py-2">{{$detail['wave_period']}} {{$lang['sec']}}</td>
                                    </tr>
                                </table>
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
