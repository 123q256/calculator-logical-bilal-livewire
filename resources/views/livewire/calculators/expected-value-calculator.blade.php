<div>
   <style>
    [x-cloak] { display: none !important; }
    .bg-gray{
        background-color: #F6FAFC !important;
    }
</style>

<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2">
                <div class="col-span-12 overflow-auto">
                    <table id="inputTable" class="text-center w-full">
                        <thead>
                            <tr class="text-center">
                                <th class="pb-2">X</th>
                                <th class="pb-2">P(x)</th>
                                <th class="pb-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($xx as $index => $value)
                                <tr wire:key="row-{{ $index }}">
                                    <td class="pt-2 pe-2">
                                        <input type="number" step="any" aria-label="X value" wire:model.live="xx.{{ $index }}" class="input" placeholder="e.g. 2">
                                    </td>
                                    <td class="pt-2 ps-2">
                                        <div class="flex items-center gap-2">
                                            <input type="number" step="any" aria-label="P(x) value" wire:model.live="px.{{ $index }}" class="input px-input" placeholder="0.2">
                                            @if(count($xx) > 2)
                                                <button type="button" wire:click="removeRow({{ $index }})" class="flex-shrink-0 p-1 hover:bg-red-100 rounded-full transition group">
                                                    <img src="{{ asset('images/delete.png') }}" width="18px" height="18px" class="cursor-pointer transition" style="filter: invert(27%) sepia(51%) saturate(2878%) hue-rotate(346deg) brightness(104%) contrast(97%);" alt="Remove">
                                                </button>
                                            @else
                                                <div class="w-[26px]"></div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-span-12 mt-4 flex justify-start">
                     <button type="button" wire:click="addRow" class="units_active bg-[#2845F5] text-white cursor-pointer px-4 py-2 rounded-md transition hover:bg-blue-700">
                        + Add Row
                     </button>
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
                                <p class="text-[20px]"><strong>{{ $lang['4'] ?? 'Expected Value E(X)' }}</strong></p>
                                <div class="flex justify-center">
                                <p class="text-[30px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ $detail['ress'] }}</strong>
                                </p>
                            </div>
                        </div>
                            <div class="w-full mt-2 overflow-auto">
                                <table class="w-full text-[18px]" style="border-collapse: collapse">
                                    <tr class="bg-[#2845F5] text-white">
                                        <td colspan="3" class="border p-2 text-center"><strong>{{ $lang['5'] ?? 'Calculation Table' }}</strong></td>
                                    </tr>
                                    <tr class="bg-gray">
                                        <td class="border p-2"><strong>x</strong></td>
                                        <td class="border p-2"><strong>P(x)</strong></td>
                                        <td class="border p-2"><strong>x * P(x)</strong></td>
                                    </tr>
                                    @php
                                        for ($i=0; $i < count($xx); $i++) {
                                            if(isset($detail['show_val'.$i])) {
                                                echo $detail['show_val'.$i];
                                            }
                                        }
                                    @endphp
                                    <tr class="bg-sky">
                                        <td class="border p-2"><strong>∑ xi = {{ $detail['sum1'] }}</strong></td>
                                        <td class="border p-2"><strong>∑ P(xi) = {{ $detail['sum2'] }}</strong></td>
                                        <td class="border p-2"><strong>∑ xi * P(xi) = {{ $detail['ress'] }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="w-full font-s-20 mt-3">{{ $lang['6'] ?? 'Step by Step Solution' }}</p>
                            <p class="w-full mt-2">{{ $lang['7'] ?? 'Expected Value Formula' }}:</p>
                            <div class="space-y-2 mt-2">
                                <p><span class="color_blue font_size20"> 1. </span>E(X) = μX = ∑ [ xi * P(xi) ]</p>
                                <p><span class="color_blue font_size20"> 2. </span>E(X) = {{ $detail['show_res'] }}</p>
                                <p><span class="color_blue font_size20"> 3. </span>E(X) = {{ $detail['show_res1'] }}</p>
                                <p><span class="color_blue font_size20"> 4. </span>E(X) = {{ $detail['ress'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
</div>
