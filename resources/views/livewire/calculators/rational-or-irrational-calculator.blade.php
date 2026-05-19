<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[50%] md:w-[50%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <label for="expression_unit" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2">
                            <select class="input" aria-label="select" wire:model.live="expression_unit" id="expression_unit">
                                <option value="1">{{$lang[2]}} (√)</option>
                                <option value="2">{{$lang[3]}} ( / )</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="num1" class="font-s-14 text-blue" id="f1_text">
                            @if ($expression_unit === '2')
                                Numerator Value
                            @else
                                {{$lang[4]}} (n)
                            @endif
                        </label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="num1" id="num1" class="input" aria-label="input" placeholder="2"/>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="num2" class="font-s-14 text-blue" id="f2_text">
                            @if ($expression_unit === '2')
                                Denominator Value
                            @else
                                {{$lang[5]}} (x)
                            @endif
                        </label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="num2" id="num2" class="input" aria-label="input" placeholder="4"/>
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                @isset($detail['final_ans'])
                                    <div class="w-full text-center font-s-20">
                                        <p>{{$lang['6']}}</p>
                                        <div class="justify-center">
                                            <p class="my-3">
                                                <strong class="bg-[#2845F5] text-white px-3 py-2 text-[32px] rounded-lg text-blue">{!! $detail['final_ans'] !!}</strong>
                                            </p>
                                            @isset($detail['exp'])
                                                <p class="my-3">{{$detail['exp']}}</p>
                                            @endisset
                                        </div>
                                    </div>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
