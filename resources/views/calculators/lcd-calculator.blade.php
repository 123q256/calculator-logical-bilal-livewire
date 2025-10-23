<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                @php $request = request();@endphp
                <div class="col-span-12">
                    <label for="x" class="font-s-14 text-blue">{{$lang[1]}} (<?=$lang['2']?>):</label>
                    <div class="w-100 py-2">
                        <textarea aria-label="textarea input" id="x" name="x" class="textareaInput">{{ isset($request->x)?$request->x:'10/4, 12/2, 4, 15/5, 2 1/7, 3 2/3, 7' }}</textarea>
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
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="80%"><strong>LCD (<?=$lang['3']?>)</strong></td>
                                        <td class="py-2 border-b"><?=$detail['lcm']?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 mt-2">
                                <p class="mt-2 text-[18px]"><strong><?=$lang['4']?> LCD</strong></p>
                                <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                    <table class="w-100 text-[18px]">
                                        @foreach($detail['input'] as $key => $value)
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><?=trim($value)?> = </td>
                                                <td class="py-2 border-b"><?=$detail['upper'][$key]*$detail['multiple'][$key]?>/<?=$detail['btm'][$key]*$detail['multiple'][$key]?></td>
                                            </tr>   
                                        @endforeach
                                    </table>
                                </div>
                                <p class="mt-2"><strong><?=$lang['5']?></strong></p>
                                <p class="mt-2"><?=$lang['6']?>:</p>
                                <p class="mt-2">
                                    <?php foreach ($detail['upper'] as $key => $value) { 
                                            if ($key!=(count($detail['upper'])-1)) {
                                                echo $value.'/'.$detail['btm'][$key].', ';
                                            }else{
                                                echo $value.'/'.$detail['btm'][$key];
                                            }
                                    } ?>
                                </p>
                                <p class="mt-2"><?=$lang['7']?> <?=$detail['lcm']?> <?=$lang['8']?> (
                                    <?php $input=''; foreach ($detail['upper'] as $key => $value) { 
                                            if ($key!=(count($detail['upper'])-1)) {
                                                echo $detail['btm'][$key].', ';
                                                $input.=$detail['btm'][$key].', ';
                                            }else{
                                                $input.=$detail['btm'][$key];
                                                echo $detail['btm'][$key];
                                            }
                                    } ?> ).</p>
                                <p class="mt-2"><?=$lang['9']?> LCM <?=$lang['10']?> <a href="https://calculator-online.net/lcm-calculator/" class="text-blue-500 underline" target="_blank">LCM Calculator</a></p>
                                <p class="mt-2"><?=$lang['11']?>, LCD (<?=$lang['3']?>) <?=$lang['12']?> <?=$detail['lcm']?></p>
                                <p class="mt-2"><?=$lang['13']?> LCD:</p>
                                <table class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                    <?php foreach ($detail['input'] as $key => $value) {?>
                                        <tr>
                                            <td class="py-2 text-center"><?=trim($value)?></td>
                                            <td class="py-2 text-center">=</td>
                                            <td class="py-2 text-center"><?=trim($value)?></td>
                                            <td class="py-2 text-center">x</td>
                                            <td class="py-2 text-center"><?=$detail['multiple'][$key]?>/<?=$detail['multiple'][$key]?></td>
                                            <td class="py-2 text-center">=</td>
                                            <td class="py-2 text-center"><?=$detail['upper'][$key]*$detail['multiple'][$key]?>/<?=$detail['btm'][$key]*$detail['multiple'][$key]?></td>
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
    @push('calculatorJS')
    @endpush
</form>
