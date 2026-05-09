<div>
   <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-2">
              
                <div class="col-span-12">
                    <label for="u" class="label">{{ $lang['1'] }} (μ):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="u" id="u" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="o" class="label">{{ $lang['2'] }} (σ):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="o" id="o" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="n" class="label">{{ $lang['3'] }} (n):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="n" id="n" class="input" aria-label="input" placeholder="00" />
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
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td class=" py-2 border-b">{{ $lang['4'] }}</td>
                                    <td class="p-2 border-b"><b>{{ $detail['x'] }}</b></td>
                                </tr>
                                <tr>
                                    <td class=" py-2 border-b">{{ $lang['5'] }}</td>
                                    <td class="p-2 border-b"><b>{{ $detail['s'] }}</b></td>
                                </tr>
                            </table>
                        </div>
                        <p class="w-full mt-3 font-s-20"><strong class="">{{$lang['6']}}:</strong></p>
                        <p class="w-full mt-2 font-s-18"><strong>{{$lang['4']}} (x)</strong></p>
                        <p class="w-full mt-2">{{$lang['4']}} (x) = {{$lang['1']}} (μ)</p>
                        <p class="w-full mt-2">{{$lang['8']}},</p>
                        <p class="w-full mt-2">{{$lang['1']}} (μ) = {{ $detail['x'] }}</p>
                        <p class="w-full mt-3 font-s-18"><strong>{{$lang['7']}} (s)</strong></p>
                        <p class="w-full mt-2">s = σ / √n</p>
                        <p class="w-full mt-2">s = {{ $detail['o'] }} / √{{ $detail['n'] }}</p>
                        <p class="w-full mt-2">s = {{ $detail['o'] }} / {{ $detail['s1'] }}</p>
                        <p class="w-full mt-2"><strong>s = {{ $detail['s'] }}</strong></p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    @endisset
</form>

</div>
