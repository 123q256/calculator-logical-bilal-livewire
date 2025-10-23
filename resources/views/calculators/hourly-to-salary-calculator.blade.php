<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="first" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="text" name="first" id="first" class="input" aria-label="input"
                            placeholder="{{ $lang['1'] }}" value="{{ isset(request()->first) ? request()->first : '15' }}" />
                            <span class="text-blue input-unit">{{$currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 tip">
                    <label for="second" class="label">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="text" name="second" id="second" class="input" aria-label="input"
                            placeholder="{{ $lang['2'] }}" value="{{ isset(request()->second) ? request()->second : '40' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 ppl">
                    <label for="third" class="label">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="text" name="third" id="third" class="input" aria-label="input"
                            placeholder="{{ $lang['3'] }}" value="{{ isset(request()->third) ? request()->third : '52' }}" />
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
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                            <table class="w-full">
                                <tr>
                                    <td class="border-b py-2"><strong><?=$lang[4]?> :</strong></td>
                                    <td class="border-b py-2"><?=$currancy.' '.$detail['annuly']?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong><?=$lang[5]?> :</strong></td>
                                    <td class="border-b py-2"><?=$currancy.' '.round($detail['monthly'], 2)?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong><?=$lang[6]?> :</strong></td>
                                    <td class="border-b py-2"><?=$currancy.' '.$detail['weekly']?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>% <?=$lang[7]?> :</strong></td>
                                    <td class="border-b py-2"><?=round(($detail['annuly'] / 56160) * 100,2) ?> %</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
