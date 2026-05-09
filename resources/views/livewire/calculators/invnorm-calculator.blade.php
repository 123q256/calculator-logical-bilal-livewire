<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-2">
                
                <div class="col-span-12">
                    <label for="p" class="font-s-14 text-blue">{{ $lang['1'] }} ({{ $lang['9'] }})</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" min="0" max="1" wire:model.live="p" id="p" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="mean" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="mean" id="mean" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="sd" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="sd" id="sd" class="input" aria-label="input" placeholder="00" />
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
    <div id="result-section" wire:key="result-{{ count((array)$detail) }}" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            @php
                                // Properties $sd, $mean, $p are automatically available.
                            @endphp
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                                <table class="w-full">
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-blue"><?=$lang['4']?></strong></td>
                                        <td class="py-2 border-b"><strong>P(z < <?=$detail['blow']?>)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-blue"><?=$lang['5']?></strong></td>
                                        <td class="py-2 border-b"><strong>P(z > <?=$detail['above']?>)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-blue"><?=$lang['6']?></strong></td>
                                        <td class="py-2 border-b"><strong>P(z < <?=$detail['ll1']?> & z > <?=$detail['ul1']?>)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-blue"><?=$lang['7']?></strong></td>
                                        <td class="py-2 border-b"><strong>P(z < <?=$detail['ll']?> & z > <?=$detail['ul']?>)</strong></td>
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
