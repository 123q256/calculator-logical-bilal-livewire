<div>
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[70%] md:w-[70%] w-full mx-auto">
            <div class="w-full my-2">
                <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
                    <span class="font-s-14 pe-2"><strong>{{ $lang['1'] }}: </strong></span>
                    <label for="raw" class="flex items-center cursor-pointer space-x-2">
                        <input type="radio" wire:model.live="form" id="raw" value="raw" class="cursor-pointer">
                        <span class="font-s-14 text-blue">{{ $lang['2'] }}:</span>
                    </label>
                    <label for="summary" class="flex items-center cursor-pointer space-x-2">
                        <input type="radio" wire:model.live="form" id="summary" value="summary" class="cursor-pointer">
                        <span class="font-s-14 text-blue">{{ $lang['3'] }}:</span>
                    </label>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-5 lg:grid-cols-2 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="x" class="font-s-14 text-blue">{!! $lang['4'] !!} (g/mol):</label>
                    <input type="number" step="any" wire:model="x" id="x" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2">
                    <label for="y" class="font-s-14 text-blue">{!! $form === 'raw' ? $lang['5'] : $lang['6'] !!}:</label>
                    <input type="number" step="any" wire:model="y" id="y" class="input" aria-label="input" placeholder="00" />
                </div>
            </div>
        </div>
        @if ($type == 'calculator')
            @include('inc.button')
        @elseif ($type == 'widget')
            @include('inc.widget-button')
        @endif
    </div>

    <hr>
    @isset($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full text-center">
                            <p><strong class="md:text-[20px] lg:text-[20px]">{!! $lang[7] !!}</strong></p>
                            <p><strong class="text-[#119154] md:text-[25px] lg:text-[25px]">{!! $detail['ans'] !!}<span class="text-[#119154] md:text-[20px] lg:text-[20px]"> {!! ($form === 'raw' ? $lang[8] : '') !!}</span></strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
</div>
