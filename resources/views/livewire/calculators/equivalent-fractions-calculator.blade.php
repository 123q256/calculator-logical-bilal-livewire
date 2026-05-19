<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <p class="label">{{$lang['1']}}:</p>
                    <select class="input" name="want_to" id="want_to" wire:model.live="want_to">
                        <option value="1">{{ $lang['2'] }}</option>
                        <option value="2">{{ $lang['3'] }}</option>
                    </select>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <p class="label">{{$lang['4']}}:</p>
                    <select class="input" name="is_frac" id="is_frac" wire:model.live="is_frac">
                        <option value="1">{{ $lang['5'] }}</option>
                        <option value="2">{{ $lang['6'] }}</option>
                    </select>
                </div>

                @if($want_to == 1)
                <div class="col-span-12 mx-auto firstt">
                    <table class="w-full">
                        <tr>
                            @if($is_frac == 2)
                            <td rowspan="2" class="frist_p pe-2">
                                <input type="number" class="input first_wNum" name="s1" wire:model.live="s1" placeholder="whole number">
                            </td>
                            @endif
                            <td class="pb-1">
                                <input type="number" name="n1" wire:model.live="n1" class="input" placeholder="numerator">
                            </td>
                        </tr>
                        <tr>
                            <td class="bdr-top pt-1">
                                <input type="number" name="d1" min="1" wire:model.live="d1" class="input" placeholder="denominator">
                            </td>
                        </tr>
                    </table>
                    <div class="col-span-12">
                        <p class="text-blue mt-3">{{$lang['6']}}:</p>
                        <input type="number" min="1" max="100" name="no" wire:model.live="no" class="input">
                    </div>
                </div>
                @endif

                @if($want_to == 2)
                <div class="col-span-12 md:col-span-6 lg:col-span-6 second pe-lg-2">
                    <table class="w-full">
                        <p class="mt-3 label text-center">{{$lang['7']}}:</p>
                        <tr>
                            @if($is_frac == 2)
                            <td rowspan="2" class="second_wNum pe-2">
                                <input type="number" name="s2" placeholder="whole number" wire:model.live="s2" class="input">
                            </td>
                            @endif
                            <td class="pb-1">
                                <input type="number" name="n2" wire:model.live="n2" placeholder="numerator" class="input">
                            </td>
                        </tr>
                        <tr>
                            <td class="bdr-top pt-1">
                                <input type="number" name="d2" min="1" placeholder="denominator" class="input" wire:model.live="d2">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 second ps-lg-2">
                    <table class="w-full">
                        <p class="mt-3 label text-center">{{$lang['8']}}:</p>
                        <tr>
                            @if($is_frac == 2)
                            <td rowspan="2" class="pe-2 second_wNum">
                                <input type="number" name="s3" placeholder="whole number" wire:model.live="s3" class="input">
                            </td>
                            @endif
                            <td class="pb-1">
                                <input type="number" name="n3" class="input" placeholder="numerator" wire:model.live="n3">
                            </td>
                        </tr>
                        <tr>
                            <td class="bdr-top pt-1">
                                <input type="number" name="d3" min="1" placeholder="denominator" class="input" wire:model.live="d3">
                            </td>
                        </tr>
                    </table>
                </div>
                @endif

            </div>
        </div>
        @if ($type == 'calculator')
            @include('inc.button')
        @endif
        @if ($type=='widget')
            @include('inc.widget-button')
        @endif
    </div>

    @if(isset($detail) && (isset($detail['upper']) || isset($detail['same'])))
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <p class="text-[16px] my-2 clr">{{$lang['9']}}</p>
                        <div>
                            @if($want_to == 1)
                                <?php if($detail['upper'][0]<$detail['bottom'][0]){ ?>
                                <p class="text-[16px]">{{$lang['9']}}</p>
                                <?php }elseif($detail['upper'][0]>$detail['bottom'][0]){ ?>
                                <p class="text-[16px] mt-1">{{$lang['10']}}</p>
                                <?php }else{ ?>
                                <p class="text-[16px] mt-1">{{$lang['11']}}</p>
                                <?php } ?>
                                <p class="text-[16px] mt-1">{{$lang['12']}}</p>
                                <p class="text-[20px] text-blue my-3 text-center"><strong>{{$lang['13']}}</strong></p>
                                <div class="overflow-auto">
                                    <table class="w-full text-[18px] text-center">
                                        @php    
                                            $i=0;
                                        @endphp
                                        @foreach ($detail['upper'] as $key => $value)
                                            @php    
                                                $i++;
                                            @endphp
                                            @if($i==1)
                                            <tr>
                                            @endif
                                            <td class="border py-2">{{$value.'/'.$detail['bottom'][$key]}}</td>
                                            @if($i==4)
                                                @php    
                                                    $i=0;
                                                @endphp
                                            </tr>
                                            @endif
                                        @endforeach
                                    </table>
                                </div>
                                <p class="text-[20px] text-blue my-3"><strong>{{$lang['14']}}:</strong></p>
                                <div class="overflow-auto">
                                    <table class="w-full text-[18px] text-center">
                                        @php
                                            $i=0;
                                            $j=0;
                                        @endphp
                                        @foreach ($detail['upper'] as $key => $value) 
                                            @php
                                            $i++;
                                            $j++;
                                            @endphp
                                            @if ($i==1) 
                                            <tr>
                                            @endif
                                            <td class="border py-2"> {{$detail['upper'][0].'/'.$detail['bottom'][0].' x '.$j.'/'.$j.' = '.$value.'/'.$detail['bottom'][$key]}}</td>
                                            @if ($i==2)
                                            @php
                                                $i=0;
                                            @endphp
                                                </tr>
                                            @endif
                                        @endforeach
                                    </table>
                                </div>
                            @else
                                @if($detail['same']=='yes')
                                    <p>{{$lang['15']}}</p>
                                @else
                                    <p>{{$lang['16']}}</p>
                                @endif
                                <div class="overflow-auto">
                                    <table class="w-full font-s-18 text-center">
                                        <tr>
                                            <td class="border py-2">{{$detail['input1']}}</td>
                                            <td class="border py-2">{{$detail['sign']}}</td>
                                            <td class="border py-2">{{$detail['input2']}}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</form>
</div>
