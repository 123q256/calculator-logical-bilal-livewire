<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-1 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="adults" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" wire:model.live="adults" id="adults" class="input" aria-label="input" placeholder="00" />
                            <span class="text-blue input_unit">#</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="children" class="label cat">{{ $lang['2'] }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" wire:model.live="children" id="children" class="input" aria-label="input" placeholder="00" />
                            <span class="text-blue input_unit">#</span>
                        </div>
                    </div> 
                    <div class="col-span-12">
                        <label for="leftovers" class="label">({{ $lang['3'] }}):</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="leftovers" id="leftovers" class="input" aria-label="input select">
                                <option value="no">{{ $lang['4'] }}</option>
                                <option value="yes">{{ $lang['5'] }}</option>
                            </select>
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
    </form>

     @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full text-center">
                                <p class="text-[20px] font-bold"><strong>{{$lang[6]}}</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-4 py-2 my-3">
                                        <strong>{{number_format($detail['turkey_weight'], 1)}}<span class="font-s-14 ml-1"> (lb)</span></strong>
                                    </p>
                                </div>
                            </div>
                            <div class="w-full md:w-[60%] lg:w-[60%] mx-auto overflow-auto mt-2 text-left">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="border-b py-2" width="60%"><strong>{{$lang[7]}}:</strong></td>
                                        <td class="border-b py-2">
                                            {{number_format($detail['inside_fridge'], 1)}}<span class="font-s-14"> (hrs)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang[8]}}:</strong></td>
                                        <td class="border-b py-2">
                                            {{number_format($detail['cold_water'], 1)}}<span class="font-s-14"> (hrs)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang[9]}}:</strong></td>
                                        <td class="border-b py-2">{{$detail['unstuffed_turkey']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang[10]}}:</strong></td>
                                        <td class="border-b py-2">{{$detail['stuffed_turkey']}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
