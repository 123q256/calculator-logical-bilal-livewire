<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[85%] w-full mx-auto">
                <div class="space-y-6">
                    <!-- Currency Selection -->
                    <div class="w-full">
                        <label for="currency" class="label font-bold text-sm mb-2 block text-gray-700">{{ $lang['1'] ?? 'Currency' }}:</label>
                        <select wire:model.live="currency" id="currency" class="input bg-white rounded-xl border-blue-500 text-sm py-3 px-4 w-full shadow-sm">
                            <option value="INR">INR - Indian Rupee</option>
                            <option value="USD">USD - US Dollar</option>
                            <option value="EUR">EUR - Euro</option>
                            <option value="JPY">JPY - Japanese Yen</option>
                            <option value="GBP">GBP - British Pound</option>
                            <option value="AUD">AUD - Australian Dollar</option>
                            <option value="CAD">CAD - Canadian Dollar</option>
                            <option value="CHF">CHF - Swiss Franc</option>
                            <option value="SEK">SEK - Swedish Krona</option>
                            <option value="MXN">MXN - Mexican Peso</option>
                            <option value="NZD">NZD - New Zealand Dollar</option>
                            <option value="PHP">PHP - Philippine Peso</option>
                        </select>
                    </div>

                    <!-- Visibility Toggles (Checkboxes) -->
                    <div class="flex justify-start gap-8 items-center py-2">
                        <label class="flex items-center cursor-pointer group">
                            <div class="relative flex items-center">
                                <input type="checkbox" wire:model.live="checkbox1" class="hidden peer">
                                <div class="w-5 h-5 border-2 border-blue-600 rounded-full flex items-center justify-center peer-checked:bg-blue-600 transition-all">
                                    <svg class="w-3 h-3 text-white peer-checked:block hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="ml-2 font-bold text-xs text-gray-700 group-hover:text-blue-600 transition-colors">{{ $lang['2'] ?? 'Banknotes' }}</span>
                            </div>
                        </label>
                        <label class="flex items-center cursor-pointer group">
                            <div class="relative flex items-center">
                                <input type="checkbox" wire:model.live="checkbox2" class="hidden peer">
                                <div class="w-5 h-5 border-2 border-blue-600 rounded-full flex items-center justify-center peer-checked:bg-blue-600 transition-all">
                                    <svg class="w-3 h-3 text-white peer-checked:block hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="ml-2 font-bold text-xs text-gray-700 group-hover:text-blue-600 transition-colors">{{ $lang['3'] ?? 'Coins' }}</span>
                            </div>
                        </label>
                        @if(!in_array($currency, ['MXN', 'PHP']))
                        <label class="flex items-center cursor-pointer group">
                            <div class="relative flex items-center">
                                <input type="checkbox" wire:model.live="checkbox3" class="hidden peer">
                                <div class="w-5 h-5 border-2 border-blue-600 rounded-full flex items-center justify-center peer-checked:bg-blue-600 transition-all">
                                    <svg class="w-3 h-3 text-white peer-checked:block hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="ml-2 font-bold text-xs text-gray-700 group-hover:text-blue-600 transition-colors">{{ $lang['4'] ?? 'Rolled Coins' }}</span>
                            </div>
                        </label>
                        @endif
                    </div>

                    <!-- Input Grid (3 Columns) -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4">
                        
                        <!-- Column 1: Banknotes -->
                        <div class="space-y-4">
                            @if($checkbox1)
                                @foreach($labels['notes'] as $index => $label)
                                <div class="space-y-1">
                                    <label class="font-bold text-xs text-black block">{{ $label }}</label>
                                    <input type="number" min="0" wire:model.live="bank_notes.{{ $index }}" class="input rounded-xl border-blue-500 py-2  w-full focus:ring-2 focus:ring-blue-200">
                                </div>
                                @endforeach
                            @endif
                        </div>

                        <!-- Column 2: Coins -->
                        <div class="space-y-4">
                            @if($checkbox2)
                                @foreach($labels['coins'] as $index => $label)
                                <div class="space-y-1">
                                    <label class="font-bold text-xs text-black block">{{ $label }}</label>
                                    <input type="number" min="0" wire:model.live="coins.{{ $index }}" class="input rounded-xl border-blue-500 py-2  w-full focus:ring-2 focus:ring-blue-200">
                                </div>
                                @endforeach
                            @endif
                        </div>

                        <!-- Column 3: Rolls -->
                        <div class="space-y-4">
                            @if($checkbox3 && !in_array($currency, ['MXN', 'PHP']))
                                @foreach($labels['rolls'] as $index => $label)
                                <div class="space-y-1">
                                    <label class="font-bold text-xs text-black block">{{ $label }}</label>
                                    <input type="number" min="0" wire:model.live="rolls.{{ $index }}" class="input rounded-xl border-blue-500 py-2  w-full focus:ring-2 focus:ring-blue-200">
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Centered Calculate Button -->
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
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-8 result">
           <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full lg:w-[80%] overflow-auto  mt-2">
                        <table class="w-full font-s-18">
                           <tr>
                              <td class="py-2 border-b" width="70%"><strong>{{ $lang[5] }}</strong></td>
                               <td class="py-2 border-b"> {{ $detail['ans_currency'] }} {{ $detail['total_money'] }}</td>
                           </tr>
                        </table>
                  </div>
                    <div class="w-full text-[16px]">
                        <div class="w-full lg:w-[80%] overflow-auto ">
                            @if($detail['checkbox1'] !== false)
                                <div class="col">
                                    <p class="col mt-3"><strong>{{ $lang[2] }}</strong></p>
                                    <table class="w-full">
                                        <thead>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[7] }}</td>
                                                <td class="py-2 border-b">{{ $lang[8] }}</td>
                                                <td class="py-2 border-b">{{ $lang[9] }}</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach($detail['note_input'] as $key => $value)
                                                <tr>
                                                    <td class="py-2 border-b">{{ $detail['ans_currency'] }} {{ $detail['note_quantity'][$key] }}</td>
                                                    <td class="py-2 border-b">{{ $value }}</td>
                                                    <td class="py-2 border-b">{{ $detail['ans_currency'] }} {{ $detail['note_total'][$key] }}</td>
                                                </tr>
                                                @endforeach
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[10] }}</td>
                                                <td class="py-2 border-b">{{ array_sum($detail['note_input']) }}</td>
                                                <td class="py-2 border-b">{{ $detail['ans_currency'] }} {{ array_sum($detail['note_total']) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            @if($detail['checkbox2'] !== false)
                                <div class="col">
                                    <p class="mt-3"><strong>{{ $lang[3] }}</strong></p>
                                    <table class="w-full">
                                        <thead>
                                            <tr>
                                                <td class="py-2 border-b" >{{ $lang[7] }}</td>
                                                <td class="py-2 border-b" >{{ $lang[8] }}</td>
                                                <td class="py-2 border-b" >{{ $lang[9] }}</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($detail['coins_input'] as $key => $value)
                                                <tr>
                                                    <td class="py-2 border-b" >{{ $detail['ans_currency'] }} {{ $detail['coins_quantity'][$key] }}</td>
                                                    <td class="py-2 border-b" >{{ $value }}</td>
                                                    <td class="py-2 border-b" >{{ $detail['ans_currency'] }} {{ $detail['coins_total'][$key] }}</td>
                                                </tr>
                                                @endforeach
                                            <tr>
                                                <td class="py-2 border-b" >{{ $lang[11] }}</td>
                                                <td class="py-2 border-b" >{{ array_sum($detail['coins_input']) }}</td>
                                                <td class="py-2 border-b" >{{ $detail['ans_currency'] }} {{ array_sum($detail['coins_total']) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            @if(($detail['currency'] === "USD" || $detail['currency'] === "EUR" || $detail['currency'] === "JPY" || $detail['currency'] === "GBP" || $detail['currency'] === "AUD" || $detail['currency'] === "CAD" || $detail['currency'] === "CHF" || $detail['currency'] === "SEK" || $detail['currency'] === "NZD" || $detail['currency'] === "INR") && $detail['checkbox3'] !== false)
                                <div class="col">
                                    <p class="mt-3"><strong>{{ $lang[12] }}</strong></p>
                                    <table class="w-full">
                                        <thead>
                                            <tr>
                                                <td class="py-2 border-b" >{{ $lang[7] }} × {{ $lang[13] }}</td>
                                                <td class="py-2 border-b" >{{ $lang[8] }}</td>
                                                <td class="py-2 border-b" >{{ $lang[9] }}</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detail['rolls_input'] as $key => $value) { ?>
                                                <tr>
                                                    <td class="py-2 border-b" >{{ $detail['ans_currency'] }} {{ $detail['rolls_quantity'][$key] }} × {{ $detail['rolls_count_ans'][$key] }}</td>
                                                    <td class="py-2 border-b" >{{ $value }}</td>
                                                    <td class="py-2 border-b" >{{ $detail['ans_currency'] }} {{ $detail['rolls_total'][$key] }}</td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td class="py-2 border-b" >{{ $lang[14]}}</td>
                                                <td class="py-2 border-b" >{{ array_sum($detail['rolls_input'])}}</td>
                                                <td class="py-2 border-b" >{{ $detail['ans_currency']}} {{ array_sum($detail['rolls_total'])}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        @endisset
    </form>
</div>
