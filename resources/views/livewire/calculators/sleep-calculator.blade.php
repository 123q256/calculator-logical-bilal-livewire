<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[50%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 gap-6">
                    <div class="text-center space-x-6">
                        <label class="inline-flex  cursor-pointer group">
                            <input type="radio" wire:model.live="stype" value="bedtime" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                            <span class="ml-2 font-s-14 text-blue font-bold group-hover:text-blue-700 transition-colors">{{ $lang['1'] }}</span>
                        </label>
                        <label class="inline-flex cursor-pointer group">
                            <input type="radio" wire:model.live="stype" value="wkup" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                            <span class="ml-2 font-s-14 text-blue font-bold group-hover:text-blue-700 transition-colors">{{ $lang['2'] }}</span>
                        </label>
                    </div>

                    <div class="space-y-2">
                        <label for="h" class="font-s-14 text-blue font-bold block text-center">
                            {{ $stype == 'bedtime' ? $lang['3'] : $lang['2'] }}
                        </label>
                        <div class="w-full py-2">
                            <input type="time" step="1" wire:model.live="h" id="h" class="input text-lg font-bold" aria-label="time" />
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

        <div id="result-section">
            @isset($detail)
                <div wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                    <div class="">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                        <div class="rounded-lg flex items-center justify-center">
                            <div class="w-full mt-3">
                                <div class="w-full">
                                    @if($detail['stype'] == 'bedtime')
                                        <p class="text-center text-[20px]"><strong>{{$lang[1]}}</strong></p>
                                        <p class="mt-3">
                                           {{$lang['5']}}
                                        </p>
                                        <p class="mt-3">
                                            {{$lang['6']}}
                                        </p>
                                    @else
                                        <p class="mt-3">
                                           {{$lang['5']}}
                                        </p>
                                        <p class="mt-3">
                                           {{$lang['7']}}
                                        </p>
                                        <p class="text-center text-[20px] mt-2"><strong>{{$lang[2]}}</strong></p>
                                    @endif
                                    <div class="grid grid-cols-12 gap-5 my-3">
                                        <div class="col-span-12 md:col-span-6 lg:col-span-6" style="border: 1px solid #c1b8b899">
                                            <div class="flex bg-[#F6FAFC] rounded-lg px-3 py-2 justify-between">
                                                <p><strong class="text-[#119154]">{{ $detail['time']}}</strong></p>
                                                <p><strong>{{$lang[4]}}</strong></p>
                                            </div>
                                        </div>
                                        <div class="col-span-12 md:col-span-6 lg:col-span-6" style="border: 1px solid #c1b8b899">
                                            <div class="flex bg-[#F6FAFC] rounded-lg px-3 py-2 justify-between">
                                                <p><strong class="text-[#119154]">{{ $detail['time2']}}</strong></p>
                                                <p><strong>{{$lang[4]}}</strong></p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="grid grid-cols-12 gap-5">
                                        <div class="col-span-12 md:col-span-3 lg:col-span-3 text-center" style="border: 1px solid #c1b8b899">
                                            <p class="bg-[#F6FAFC] px-3 py-2 rounded-lg"><strong class="text-[#119154]">{{$detail['time3']}}</strong></p>
                                        </div>
                                        <div class="col-span-12 md:col-span-3 lg:col-span-3 text-center" style="border: 1px solid #c1b8b899">
                                            <p class="bg-[#F6FAFC] px-3 py-2 rounded-lg"><strong class="text-[#119154]">{{$detail['time4']}}</strong></p>
                                        </div>
                                        <div class="col-span-12 md:col-span-3 lg:col-span-3 text-center" style="border: 1px solid #c1b8b899">
                                            <p class="bg-[#F6FAFC] px-3 py-2 rounded-lg"><strong class="text-[#119154]">{{$detail['time5']}}</strong></p>
                                        </div>
                                        <div class="col-span-12 md:col-span-3 lg:col-span-3 text-center" style="border: 1px solid #c1b8b899">
                                            <p class="bg-[#F6FAFC] px-3 py-2 rounded-lg"><strong class="text-[#119154]">{{$detail['time6']}}</strong></p>
                                        </div>
                                    </div>
                                    @if($detail['stype'] == 'bedtime')
                                        <p class="mt-3">
                                            {{$lang['8']}}
                                        </p>
                                        <p class="mt-3">
                                            {{$lang['9']}}
                                        </p>
                                    @else
                                        <p class="mt-3">
                                            {{$lang['8']}}
                                        </p>
                                        <p class="mt-3">
                                            {{$lang['9']}}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </form>
</div>
