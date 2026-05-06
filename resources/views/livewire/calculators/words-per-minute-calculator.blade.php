<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <p class="mt-2 col-span-12"><strong class="text-blue">{{ $lang[1] }}</strong></p>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="speak_speed" class="label">{{ $lang['2'] }} :</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="speak_speed" id="speak_speed" class="input">
                                <option value="100">{{ $lang[3] }} (100 wpm)</option>
                                <option value="130">{{ $lang[4] }} (130 wpm)</option>
                                <option value="160">{{ $lang[5] }} (160 wpm)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="ss" class="label">{{ $lang[2] }} :</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="ss" id="ss" class="input" aria-label="input" placeholder="160" />
                            <span class="input_unit text-blue">wpm</span>
                        </div>
                    </div>

                    <p class="col-span-12"><strong class="text-blue">{{ $lang[6] }}</strong></p>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="reading_speed" class="label">{{ $lang['7'] }} :</label>
                        <div class="w-100 py-2 relative">
                            <select wire:model.live="reading_speed" id="reading_speed" class="input">
                                <option value="170">{{ $lang[3] }} (170 wpm)</option>
                                <option value="200">{{ $lang[4] }} (200 wpm)</option>
                                <option value="230">{{ $lang[5] }} (230 wpm)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="rs" class="label">{{ $lang['7'] }} :</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="rs" id="rs" class="input" aria-label="input" placeholder="140" />
                            <span class="input_unit text-blue">wpm</span>
                        </div>
                    </div>

                    <p class="col-span-12"><strong class="text-blue">{{ $lang[8] }}</strong></p>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="select" class="label">{{ $lang['9'] }} :</label>
                        <div class="w-100 py-2 relative">
                            <select wire:model.live="select" id="select" class="input">
                                <option value="1">{{ $lang[10] }}</option>
                                <option value="2">{{ $lang[11] }}</option>
                            </select>
                        </div>
                    </div>

                    @if ($select == '1')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="words" class="label">{{ $lang['10'] }} :</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="words" id="words" class="input" aria-label="input" placeholder="3400" />
                            </div>
                        </div>
                    @else
                        <div class="col-span-12 paragraph">
                            <label for="x" class="label">{{ $lang['10'] }} :</label>
                            <div class="w-100 py-2">
                                <textarea wire:model.live="x" id="x" class="textareaInput" rows="5"></textarea>
                            </div>
                        </div>
                    @endif
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
        <div id="result-section">
            @isset($detail)
                <div wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                   <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                        @php
                            $sec = $detail['speak_ans'] * 60;
                            $sec = round($sec, 2);
                            $min = round($detail['speak_ans'], 2);
                            $hrs = $detail['speak_ans'] / 60;
                            $hrs = round($hrs, 2);
                            $days = $detail['speak_ans'] / 1440;
                            $days = round($days, 2);
                            $sec2 = $detail['read_ans'] * 60;
                            $sec2 = round($sec2, 2);
                            $min2 = round($detail['read_ans'], 2);
                            $hrs2 = $detail['read_ans'] / 60;
                            $hrs2 = round($hrs2, 2);
                            $days2 = $detail['read_ans'] / 1440;
                            $days2 = round($days2, 2); 
                        @endphp
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 lg:text-[18px] md:text-[18px] text-[16px] border-lg-end pe-lg-3">
                            <p>{{$lang[13]}}</p>
                            <p class="font-s-25 mt-2"><strong class="text-[#119154]">{{$detail['speak_time']}}</strong></p>
                            <table class="w-full">
                                <tr>
                                    <td width="70%" class="border-b py-2">{{$lang['13']}} (sec)</td>
                                    <td class="border-b py-2">
                                        {{$sec}}<span class="font-s-14"> sec</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang['13']}} (min)</td>
                                    <td class="border-b py-2">
                                        {{$min}}<span class="font-s-14"> min</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang['13']}} (hrs)</td>
                                    <td class="border-b py-2">
                                        {{$hrs}}<span class="font-s-14"> hrs</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang['13']}} (days)</td>
                                    <td class="border-b py-2">
                                        {{$days}}<span class="font-s-14"> days</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 lg:text-[18px] md:text-[18px] text-[16px] ps-lg-3">
                            <p>{{$lang[14]}}</p>
                            <p class="font-s-25 mt-2"><strong class="text-[#119154]">{{$detail['read_time']}}</strong></p>
                            <table class="w-full">
                                <tr>
                                    <td width="70%" class="border-b py-2">{{$lang['14']}} (sec)</td>
                                    <td class="border-b py-2">
                                        {{$sec2}}<span class="font-s-14"> sec</span>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang['14']}} (min)</td>
                                    <td class="border-b py-2">
                                        {{$min2}}<span class="font-s-14"> min</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang['14']}} (hrs)</td>
                                    <td class="border-b py-2">
                                        {{$hrs2}}<span class="font-s-14"> hrs</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang['14']}} (days)</td>
                                    <td class="border-b py-2">
                                        {{$days2}}<span class="font-s-14"> days</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                </div>
            @endisset
        </div>
    </form>
</div>
