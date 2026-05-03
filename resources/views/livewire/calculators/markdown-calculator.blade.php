<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="osp" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Original Selling Price' }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="osp" id="osp" class="input" aria-label="osp" placeholder="12" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="asp" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Actual Selling Price' }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="asp" id="asp" class="input" aria-label="asp" placeholder="11" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
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
        <hr>
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="lg:w-[80%] w-full overflow-auto mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] ?? 'Markdown' }} </strong></td>
                                        <td class="py-2 border-b"> {{ $currency }} {{ $detail['markdown'] }} </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] ?? 'Markdown Percentage' }} </strong></td>
                                        <td class="py-2 border-b"> {{ $detail['markdown_percent'] }} %</td>
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
