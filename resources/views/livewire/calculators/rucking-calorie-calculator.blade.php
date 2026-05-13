<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-12 gap-x-8 gap-y-6">
                    {{-- Activities Radio Grid (Simplified) --}}
                    <div class="col-span-12">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            @foreach ([
                                'btn1' => ['val' => '0.95', 'key' => '2'],
                                'btn2' => ['val' => '3.0',  'key' => '3'],
                                'btn3' => ['val' => '7.8',  'key' => '4'],
                                'btn4' => ['val' => '8.5',  'key' => '5'],
                                'btn5' => ['val' => '8.2',  'key' => '6'],
                                'btn6' => ['val' => '9.0',  'key' => '7'],
                                'btn7' => ['val' => '10.0', 'key' => '8'],
                                'btn8' => ['val' => '10.7', 'key' => '9'],
                                'btn9' => ['val' => '8.0',  'key' => '10'],
                                'btn10' => ['val' => '4.5', 'key' => '11'],
                            ] as $id => $item)
                                <div class="flex items-center space-x-2">
                                    <input type="radio" wire:model.live="activities" id="{{ $id }}" value="{{ $item['val'] }}" class="w-4 h-4 text-[#2845F5] focus:ring-[#2845F5]">
                                    <label for="{{ $id }}" class="text-xs  cursor-pointer">{{ $lang[$item['key']] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Weight --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['12'] !!}:</label>
                        <div class="relative">
                            <input type="number" wire:model.live="weight" step="any" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-10" placeholder="150">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs font-bold">lbs</span>
                        </div>
                    </div>

                    {{-- Time --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['13'] !!}:</label>
                        <div class="relative">
                            <input type="number" wire:model.live="time" step="any" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-16" placeholder="1">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs font-bold">hours</span>
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
        </div>

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full text-center space-y-2">
                                <p class="text-gray-600 font-medium">{{ $lang[14] }}</p>
                                <p><strong class="text-green-700 text-[48px]">{{ $detail['calories'] }}</strong> <span class="text-green-700 font-bold text-xl">kcal</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
