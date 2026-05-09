<div>
 <form wire:submit.prevent="calculate">
  
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                    <div class="space-y-2 relative">
                        <label for="success" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <input type="number" step="any" wire:model.live="success" id="success" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2">
                        <label for="trials" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                        <input type="number" step="any" wire:model.live="trials" id="trials" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2 relative">
                        <label for="ci" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                        <input type="number" step="any" wire:model.live="ci" id="ci" min="0" max="99.99" class="input" aria-label="input" placeholder="00" />
                        <span class="text-blue input_unit">%</span>
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
                    <div class="w-full  mt-3">
                        <div class="row">
                            <div class="text-center">
                                <p class="font-s-20"><strong>{{$lang['4']}}</strong></p>
                                <p class="radius-10 d-inline-block my-3">
                                    <strong class="bg-[#2845F5] text-white text-[30px] rounded-lg px-3 py-2">{{ $detail['pe'] }}</strong>
                                </p>
                            </div>
                            <div class="col-lg-7 mt-2 overflow-auto">
                                <table class="w-100">
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]">{{ $lang['5'] }}</strong></td>
                                        <td class="py-2 border-b">{{ $detail['z'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]">{{ $lang['6'] }} (MLE)</strong></td>
                                        <td class="py-2 border-b">{{ $detail['mle'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]">{{ $lang['7'] }}</strong></td>
                                        <td class="py-2 border-b">{{ $detail['laplace'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]">{{ $lang['8'] }}</strong></td>
                                        <td class="py-2 border-b">{{ $detail['jeffrey'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]">{{ $lang['9'] }}</strong></td>
                                        <td class="py-2 border-b">{{ $detail['wilson'] }}</td>
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
