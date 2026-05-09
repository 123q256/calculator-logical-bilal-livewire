<div>
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  mt-3  gap-4">
            <div class="space-y-2">
                <label for="textarea" class="font-s-14 text-blue">{{ $lang['5'] ?? 'Enter Numbers' }}:</label>
                <div class="w-100 py-2">
                    <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 20, 30, 15
20 50 56 88" wire:model.live="x"></textarea>
                </div>
            </div>
            <div class="space-y-2 hidden">
                <label for="seprate" class="font-s-14 text-blue">&nbsp;</label>
                <div class="w-100 py-2">
                    <input type="text" name="seprate" id="seprate" class="input readonly" readonly aria-label="input" placeholder=" " wire:model.live="seprate" />
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
                                <p class="font-s-20"><strong>{{ $lang['9'] ?? 'Geometric Mean' }}</strong></p>
                                <div class="flex justify-center">
                                <p class="text-[32px] w-auto bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">
                                        @if (isset($detail['geo']))
                                            {{ $detail['geo'] }}
                                        @else
                                            {{ round(pow(array_product($detail['numbers']), (1/$detail['count'])),4) }}
                                        @endif
                                    </strong>
                                </p>
                            </div>
                        </div>
                            @isset($detail['textline'])
                                <p>Note: The negative values are detected in the input. All values will be treated as percentages (e.g., -20 will be treated as -20%).</p>
                            @endisset
                            <p class="w-full mt-2 font-s-18"><strong class="text-blue ">{{$lang['sol'] ?? 'Solution'}}:</strong></p>
                            <p class="w-full mt-2">{{ $lang['9'] ?? 'Geometric Mean' }} = <sup>{{ $detail['count'] }}</sup>&radic;{{ $detail['sol'] }}</p>
                            @if (isset($detail['geo']))
                                <p class="w-full mt-2">{{ $lang['9'] ?? 'Geometric Mean' }} = <sup>{{ $detail['count'] }}</sup>&radic;{{ $detail['sol1'] }}</p>
                                <p class="w-full mt-2">{{ $lang['9'] ?? 'Geometric Mean' }} = <sup>{{ $detail['count'] }}</sup>&radic;{{ $detail['pro'] }}</p>
                                <p class="w-full mt-2">{{ $lang['9'] ?? 'Geometric Mean' }} = {{ round(pow($detail['pro'], (1/$detail['count'])),4) }}</p>
                                <p class="w-full mt-2">{{ $lang['9'] ?? 'Geometric Mean' }} = ({{ round(pow($detail['pro'], (1/$detail['count'])),4) }} - 1) x 100</p>
                                <p class="w-full mt-2">{{ $lang['9'] ?? 'Geometric Mean' }} = {{ $detail['geo'] }}</p>
                            @else
                                <p class="w-full mt-2">{{ $lang['9'] ?? 'Geometric Mean' }} = <sup>{{ $detail['count'] }}</sup>&radic;{{ array_product($detail['numbers']) }}</p>
                                <p class="w-full mt-2">{{ $lang['9'] ?? 'Geometric Mean' }} = {{ round(pow(array_product($detail['numbers']), (1/$detail['count'])),4) }}</p>
                            @endif
                            <div class="w-full mt-2">
                                <strong class="text-blue font-s-18">{{$lang['other_key'] ?? 'Other Values'}}</strong>
                                <div class="lg:w-[70%] w-full overflow-auto">
                                <table class="w-full">
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['10'] ?? 'Input Data' }}:</td>
                                        <td class="py-2 border-b">
                                            @foreach ($detail['numbers'] as $key => $value)
                                                {{ $value }}{{ $key == ($detail['count'] - 1) ? '' : ' , ' }}
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['11'] ?? 'Sorted Data' }}:</td>
                                        <td class="py-2 border-b">
                                            @php
                                                $sortedNumbers = $detail['numbers'];
                                                rsort($sortedNumbers);
                                            @endphp
                                            @foreach ($sortedNumbers as $key => $value)
                                                {{ $value }}{{ $key == ($detail['count'] - 1) ? '' : ' , ' }}
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['12'] ?? 'Even Numbers' }}:</td>
                                        <td class="py-2 border-b">
                                            @foreach ($detail['numbers'] as $value)
                                                @if ($value % 2 == 0)
                                                    {{ $value }} ,
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['13'] ?? 'Odd Numbers' }}:</td>
                                        <td class="py-2 border-b">
                                            @foreach ($detail['numbers'] as $value)
                                                @if ($value % 2 != 0)
                                                    {{ $value }} ,
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['14'] ?? 'Sum' }}:</td>
                                        <td class="py-2 border-b">
                                            {{ array_sum($detail['numbers']) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['15'] ?? 'Maximum' }}:</td>
                                        <td class="py-2 border-b">
                                            {{ max($detail['numbers']) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['16'] ?? 'Minimum' }}:</td>
                                        <td class="py-2 border-b">
                                            {{ min($detail['numbers']) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['17'] ?? 'Count' }}:</td>
                                        <td class="py-2 border-b">
                                            {{ count($detail['numbers']) }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @endisset
</form>
</div>
