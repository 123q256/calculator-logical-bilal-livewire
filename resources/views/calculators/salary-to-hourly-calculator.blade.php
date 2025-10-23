<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="type" class="label">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2">
                        <select class="input" name="type" id="type">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = [$lang['3'], $lang['4'], $lang['5'], $lang['6']];
                                $val = ["an","mo","we","da"];
                                optionsList($val,$name,isset(request()->type)?request()->type:'an');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="salary" class="label">{{ $lang['7'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="text" name="salary" id="salary" class="input" aria-label="input"
                            placeholder="{{ $lang['1'] }}" value="{{ isset(request()->salary) ? request()->salary : '30000' }}" />
                            <span class="text-blue input_unit">{{$currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6tip ">
                    <label for="hweek" class="label">{{ $lang['8'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="text" name="hweek" id="hweek" class="input" aria-label="input"
                            placeholder="{{ $lang['2'] }}" value="{{ isset(request()->hweek) ? request()->hweek : '40' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 ppl ">
                    <label for="hyear" class="label">{{ $lang['9'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="text" name="hyear" id="hyear" class="input" aria-label="input"
                            placeholder="{{ $lang['3'] }}" value="{{ isset(request()->hyear) ? request()->hyear : '52' }}" />
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
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{$lang['10']}}</strong></p>
                            <div class="flex justify-center">
                            <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3"><strong class="text-blue"><?=$currancy.' '.round($detail['hourly_rate'],2)?></strong></p>
                        </div>
                    </div>
                        <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                            <table class="w-full">
                                <tr>
                                    <td class="border-b py-2"><strong><?=$lang[11]?> :</strong></td>
                                    <td class="border-b py-2"><?=$currancy.' '.round($detail['monthaly_rate'], 2)?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong><?=$lang[12]?> :</strong></td>
                                    <td class="border-b py-2"><?=$currancy.' '.round($detail['weekly_rate'],2)?></td>
                                </tr>
                                <?php if($currancy == '$' or $currancy == '£') {?>  
                                    <tr>
                                        <td class="border-b py-2"><strong>% <?= $detail['name']?> <?= $lang[7] ?> :</strong></td>
                                        <td class="border-b py-2"><?=round($detail['mean'],2) ?> %</td>
                                    </tr>
                                <?php } ?>  
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
