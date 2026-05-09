<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    
                    <div class="col-span-8 px-2">
                        <label for="seprateby" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Separate By' }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select name="seprateby" id="seprateby" class="input" wire:model.live="seprateby">
                                <option value="space">{{ $lang['2'] ?? 'Space' }}</option>
                                <option value=",">{{ $lang['3'] ?? 'Comma' }}</option>
                                <option value="user">{{ $lang['4'] ?? 'User' }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-4 px-2">
                        <label for="seprate" class="font-s-14 text-blue">&nbsp;</label>
                        <div class="w-100 py-2">
                            <input type="text" name="seprate" id="seprate" class="input readonly" aria-label="input" placeholder=" " wire:model.live="seprate" {{ $seprateby != 'user' ? 'readonly' : '' }} />
                        </div>
                    </div>
                    <div class="col-span-12 px-2">
                        <label for="textarea" class="font-s-14 text-blue">{{ $lang['5'] ?? 'Enter Numbers' }}:</label>
                        <div class="w-100 py-2">
                            <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 12 32 12 33 4 21" wire:model.live="x"></textarea>
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
                           
                            <p class="text-[20px]"><strong>{{ $lang['9'] ?? 'Harmonic Mean' }}</strong></p>
                            <div class="flex justify-center">
                            <p class="text-[25px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                <strong class="text-white">{{ $detail['ans'] }}</strong>
                            </p>
                        </div>
                    </div>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 px-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['10'] ?? 'Input Data' }}:</td>
                                    <td class="py-2 border-b"><strong>
                                        @foreach ($detail['numbers'] as $key => $value)
                                            {{ $value }}{{ $key == ($detail['count'] - 1) ? '' : ' , ' }}
                                        @endforeach
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['11'] ?? 'Sorted Data' }}:</td>
                                    <td class="py-2 border-b"><strong>
                                        @php
                                            $sortedNumbers = $detail['numbers'];
                                            rsort($sortedNumbers);
                                        @endphp
                                        @foreach ($sortedNumbers as $key => $value)
                                            {{ $value }}{{ $key == ($detail['count'] - 1) ? '' : ' , ' }}
                                        @endforeach
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['12'] ?? 'Even Numbers' }}:</td>
                                    <td class="py-2 border-b"><strong>
                                        @foreach ($detail['numbers'] as $value)
                                            @if ($value % 2 == 0)
                                                {{ $value }} ,
                                            @endif
                                        @endforeach
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['13'] ?? 'Odd Numbers' }}:</td>
                                    <td class="py-2 border-b"><strong>
                                        @foreach ($detail['numbers'] as $value)
                                            @if ($value % 2 != 0)
                                                {{ $value }} ,
                                            @endif
                                        @endforeach
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['14'] ?? 'Sum' }}:</td>
                                    <td class="py-2 border-b"><strong>
                                        {{ array_sum($detail['numbers']) }}
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['15'] ?? 'Maximum' }}:</td>
                                    <td class="py-2 border-b"><strong>
                                        {{ max($detail['numbers']) }}
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['16'] ?? 'Minimum' }}:</td>
                                    <td class="py-2 border-b"><strong>
                                        {{ min($detail['numbers']) }}
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['17'] ?? 'Count' }}:</td>
                                    <td class="py-2 border-b"><strong>
                                        {{ count($detail['numbers']) }}
                                    </strong></td>
                                </tr>
                                @if (isset($detail['s_d_p']))
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['psd'] ?? 'Population Standard Deviation' }}:</td>
                                    <td class="py-2 border-b"><strong>{{ $detail['s_d_p'] }}</strong></td>
                                </tr>
                                @endif
                                @if (isset($detail['s_d_s']))
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['ssd'] ?? 'Sample Standard Deviation' }}:</td>
                                    <td class="py-2 border-b"><strong>{{ $detail['s_d_s'] }}</strong></td>
                                </tr>
                                @endif
                                @if (isset($detail['iter']))
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['iqr'] ?? 'Interquartile Range' }}:</td>
                                    <td class="py-2 border-b"><strong>{{ $detail['iter'] }}</strong></td>
                                </tr>
                                @endif
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
