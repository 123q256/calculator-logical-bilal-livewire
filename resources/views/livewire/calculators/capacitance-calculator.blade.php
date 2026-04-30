<div>
 <form wire:submit.prevent="calculate">
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 md:col-span-6">
                    <label for="area" class="font-s-14 text-blue">{{ $lang[1] }} (A):</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" wire:model.live="area" id="area" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                       <label for="area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="$toggle('area_open')">{{ $area_unit }} ▾</label>
                       @if($area_open)
                       <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setAreaUnit('mm²')">mm²</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setAreaUnit('cm²')">cm²</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setAreaUnit('m²')">m²</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setAreaUnit('in²')">in²</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setAreaUnit('ft²')">ft²</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setAreaUnit('yd²')">yd²</p>
                       </div>
                       @endif
                    </div>
                  </div>
                <div class="col-span-12 md:col-span-6">
                    <label for="permittivity" class="font-s-14 text-blue">{{ $lang[2] }} (ε):</label>
                    <div class="w-full py-2 relative">
                        <input type="text" wire:model.live="permittivity" id="permittivity" class="input" placeholder="00" />
                        <span class="text-blue absolute right-4 top-4 font-semibold">F/m</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6">
                    <label for="distance" class="font-s-14 text-blue">{{ $lang[3] }} (s):</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" wire:model.live="distance" id="distance" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                       <label for="dis_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="$toggle('dis_open')">{{ $dis_unit }} ▾</label>
                       @if($dis_open)
                       <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setDisUnit('mm')">mm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setDisUnit('cm')">cm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setDisUnit('m')">m</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setDisUnit('in')">in</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setDisUnit('ft')">ft</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setDisUnit('yd')">yd</p>
                       </div>
                       @endif
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <p class="w-full text-[18px]">{{ $lang[4] }}</p>
                            <div class="w-full  md:w-[90%] lg:w-[90%] mt-2 overflow-auto">
                                <table class="w-full">
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ $detail['mf_ans'] }}</strong></td>
                                        <td class="p-2 border-b">mF</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ $detail['f_ans'] }}</strong></td>
                                        <td class="p-2 border-b">F</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ $detail['microf_ans'] }}</strong></td>
                                        <td class="p-2 border-b">μF</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ $detail['nf_ans'] }}</strong></td>
                                        <td class="p-2 border-b">nF</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ $detail['pf_ans'] }}</strong></td>
                                        <td class="p-2 border-b">pF</td>
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
