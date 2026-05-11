<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-3 lg:gap-3">
                    {{-- Bilirubin --}}
                    <div class="col-span-12">
                        <label for="b" class="font-s-14 text-blue">{!! $lang['b'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="b" id="b" class="input">
                                <option value="1"><2 mg/dL (<34.2 µmol/L)</option>
                                <option value="2">2-3 mg/dL (34.2-51.3 µmol/L)</option>
                                <option value="3">>3 mg/dL (>51.3 µmol/L)</option>
                            </select>
                        </div>
                    </div>

                    {{-- Albumin --}}
                    <div class="col-span-12">
                        <label for="a" class="font-s-14 text-blue">{!! $lang['a'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="a" id="a" class="input">
                                <option value="1">>3.5 g/dL (>35 g/L)</option>
                                <option value="2">2.8-3.5 g/dL (28-35 g/L)</option>
                                <option value="3"><2.8 g/dL (<28 g/L)</option>
                            </select>
                        </div>
                    </div>

                    {{-- INR --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="i" class="font-s-14 text-blue">{!! $lang['i'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="i" id="i" class="input">
                                <option value="1"><1.7</option>
                                <option value="2">1.7-2.2</option>
                                <option value="3">>2.2</option>
                            </select>
                        </div>
                    </div>

                    {{-- Ascites --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="as" class="font-s-14 text-blue">{!! $lang['as'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="as" id="as" class="input">
                                <option value="1">{{ $lang['a1'] }}</option>
                                <option value="2">{{ $lang['a2'] }}</option>
                                <option value="3">{{ $lang['a3'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Encephalopathy --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="e" class="font-s-14 text-blue">{!! $lang['e'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="e" id="e" class="input">
                                <option value="1">{{ $lang['e1'] }}</option>
                                <option value="2">{{ $lang['e2'] }}</option>
                                <option value="3">{{ $lang['e3'] }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <p class="w-full text-[20px] mt-2"><strong>{{ $cal_name }}</strong></p>
                                <p class="w-full text-[28px]">
                                    @if(isset($detail['ans']))
                                        <strong class="text-green-500">{!! $detail['ans'] !!}</strong>
                                    @else
                                        <strong class="text-green-500">0.0 <span class="text-green-500 text-[25px]">Points</span></strong>
                                    @endif
                                </p>
                                <p class="w-full text-[25px] mt-2">
                                    <strong class="font-s-21">{{ $lang['class'] }} :</strong>
                                    @if(isset($detail['class']))
                                        <strong>{!! $detail['class'] !!}</strong>
                                    @else
                                        <strong>Nan</strong>
                                    @endif
                                </p>
                                <p class="w-full text-[18px] mt-2">
                                    {{ $detail['ansa'] ?? $lang['life'] }}
                                </p>
                                <div class="w-10/12 border-t my-3"></div>
                                <p class="w-full text-[18px]">
                                    {{ $detail['ansb'] ?? $lang['inter'] }}
                                </p>
                                <div class="w-10/12 border-t my-3"></div>
                                <p class="w-full text-[18px]">
                                    <span>{{ $lang['one_y'] }} :</span>
                                    @if(isset($detail['percent1']))
                                        <strong>{{ $detail['percent1'] }} %</strong>
                                    @else
                                        <strong>00 %</strong>
                                    @endif
                                </p>
                                <div class="w-10/12 border-t my-3"></div>
                                <p class="w-full text-[18px]">
                                    <span>{{ $lang['two_y'] }} :</span>
                                    @if(isset($detail['percent2']))
                                        <strong>{{ $detail['percent2'] }} %</strong>
                                    @else
                                        <strong>00 %</strong>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
