<div>
 <style>
    [x-cloak] { display: none !important; }
</style>

<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3"
         x-data="{ form: @entangle('form') }">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-4">
                
                <div class="col-span-12">
                    <div class="flex flex-col md:flex-row lg:flex-row md:items-center justify-between gap-4">
                        <p class="font-semibold">{{ $lang['1'] ?? 'Calculation From' }}</p>

                        <div class="flex items-center gap-4">
                            <div class="flex items-center cursor-pointer">
                                <input name="form" id="form" class="r_data cursor-pointer" value="raw" type="radio" wire:model.live="form" />
                                <label for="form" class="font-s-14 px-2 cursor-pointer mb-0">{{ $lang['2'] ?? 'Raw Data' }}</label>
                            </div>
                            
                            <div class="flex items-center cursor-pointer">
                                <input name="form" id="form1" class="s_data cursor-pointer" value="summary" type="radio" wire:model.live="form" />
                                <label for="form1" class="font-s-14 px-2 cursor-pointer mb-0">{{ $lang['3'] ?? 'Summary' }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12" x-show="form == 'summary'" x-cloak>
                    <div class="grid grid-cols-12  gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="deviation" class="font-s-14 ">{{ $lang['4'] ?? 'Standard Deviation' }} σ:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="deviation" id="deviation" class="input" aria-label="input" placeholder="e.g. 8.3016" wire:model.live="deviation" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 sample">
                            <label for="sample" class="font-s-14 ">{{ $lang['5'] ?? 'Sample Size' }} (n):</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="sample" id="sample" class="input" aria-label="input" placeholder="e.g. 4" wire:model.live="sample" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12" x-show="form == 'raw'">
                    <label for="x" class="font-s-14 ">{{ $lang['6'] ?? 'Dataset' }} ({{ $lang['7'] ?? 'comma separated' }})</label>
                    <div class="w-100 py-2">
                        <textarea name="x" id="x" class="textareaInput" aria-label="input" placeholder="e.g. 12, 23, 45, 33, 65, 54, 54" wire:model.live="x"></textarea>
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
                                <div class="text-center">
                                    <p class="text-[25]"><strong>{{ $lang['14'] ?? 'Standard Error' }}</strong></p>
                                    <div class="flex justify-center">
                                    <p class="text-[30px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-white">{{ $detail['se'] }}</strong>
                                    </p>
                                </div>
                            </div>
                                @if ($detail['form']=='raw')
                                    <div class="lg:w-[80%] w-full overflow-auto mt-2">
                                        <table class="w-full text-[18px]">
                                            <tr>
                                                <td class=" py-2 border-b">{{ $lang['9'] ?? 'Sample Size' }} n</td>
                                                <td class="py-2 border-b"><strong>{{ $detail['count'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class=" py-2 border-b">{{ $lang['10'] ?? 'Sum' }} ∑ x</td>
                                                <td class="py-2 border-b"><strong>{{ $detail['sum'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class=" py-2 border-b">{{ $lang['11'] ?? 'Mean' }} x̄</td>
                                                <td class="py-2 border-b"><strong>{{ $detail['mean'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class=" py-2 border-b">{{ $lang['4'] ?? 'Std Dev' }} σ</td>
                                                <td class="py-2 border-b"><strong>{{ $detail['e'] }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p class="w-full mt-3 text-[20px] ">{{ $lang['12'] ?? 'Step by Step' }}</p>
                                    <p class="w-full mt-2">{{ $lang['8'] ?? 'Dataset' }} : ({{ $x }})</p>
                                    <p class="w-full mt-2">{{ $lang['9'] ?? 'Count' }} : {{ $detail['count'] }}</p>
                                    <p class="w-full mt-2">{{ $lang['13'] ?? 'Formula' }} = σ / √n </p>
                                    <p class="w-full mt-2"> σ = {{ $lang['4'] ?? 'Std Dev' }} </p>
                                    <p class="w-full mt-2"> σ =√( ∑ (x - x̄)² / n - 1 )</p>
                                    <p class="w-full mt-2"> x = {{ $lang['15'] ?? 'Raw values' }}</p>
                                    <p class="w-full mt-2"> x̄ = {{ $lang['11'] ?? 'Mean' }}</p>
                                    <p class="w-full mt-2"> n = {{ $lang['9'] ?? 'Count' }}</p>
                                    <p class="w-full mt-2"> σ = √(1/{{ $detail['count'] }}-1) * ({!! $detail['v1'] !!})</p>
                                    <p class="w-full mt-2"> σ = √(1/{{ $detail['v2'] }}) * ({!! $detail['v'] !!})</p>
                                    <p class="w-full mt-2"> σ = √(1/{{ $detail['v2'] }}) * ({!! $detail['v3'] !!})</p>
                                    <p class="w-full mt-2"> σ = √(1/{{ $detail['v2'] }}) * ({{ $detail['c'] }})</p>
                                    <p class="w-full mt-2"> σ = √({{ $detail['v4'] }}) * ({{ $detail['c'] }})</p>
                                    <p class="w-full mt-2"> σ = √{{ $detail['v5'] }}</p>
                                    <p class="w-full mt-2"> σ = √{{ $detail['rv'] }}</p>
                                    <p class="w-full mt-2"> {{ $lang['14'] ?? 'SE' }} = σ / √n</p>
                                    <p class="w-full mt-2"> {{ $lang['14'] ?? 'SE' }} = {{ $detail['rv'] }} / √{{ $detail['count'] }}</p>
                                    <p class="w-full mt-2"> {{ $lang['14'] ?? 'SE' }} = {{ $detail['rv'] }} / {{ $detail['v6'] }}</p>
                                    <p class="w-full mt-2  text-[20px]"> {{ $lang['14'] ?? 'SE' }} = {{ $detail['v7'] }}</p>
                                @else
                                    <p class="w-full mt-3 text-[20px] ">{{ $lang['12'] ?? 'Step by Step' }}</p>
                                    <p class="w-full mt-2"> σ = {{ $deviation }}</p>
                                    <p class="w-full mt-2"> n = {{ $sample }}</p>
                                    <p class="w-full mt-2">{{ $lang['13'] ?? 'Formula' }} = σ / √n </p>
                                    <p class="w-full mt-2">{{ $lang['14'] ?? 'SE' }} = {{ $deviation }} / √ {{ $sample }} </p>
                                    <p class="w-full mt-2">{{ $lang['14'] ?? 'SE' }} = {{ $deviation }} / {{ $detail['sn'] }} </p>
                                    <p class="w-full mt-2 text-[20px] "><strong>{{ $lang['14'] ?? 'SE' }} = {{ $detail['se'] }}</strong> </p>
                                @endif
                            </div>
                        </div>
                </div>
            </div>
        </div>
    @endisset
</form>
</div>
