<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="percent" class="font-s-14 text-blue">{{ $lang['1'] }} %:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="percent" id="percent" class="input" value="{{ isset($_POST['percent'])?$_POST['percent']:'3' }}" aria-label="input"/>
                    <span class="text-blue input_unit">%</span>
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
                                        <td class="py-2 border-b" width="55%"><strong>{{$lang['ans']}} {{$_POST['percent']}}% = </strong></td>
                                        <td class="py-2 border-b">
                                            <span class="quadratic_fraction">
                                                <span class="num">{{$detail['uper']}}</span>
                                                <span>{{$detail['btm']}}</span>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full">
                                <p class="mt-2"><strong>{{$lang['ex']}}</strong></p>
                                <p class="mt-2">
                                    {{$lang['step']}} # 1 = 
                                    <span class="quadratic_fraction">
                                        <span class="num">{{$_POST['percent']}}</span>
                                        <span>100</span>
                                    </span> = {{$_POST['percent']/100}}
                                </p>
                                <p class="mt-2">
                                    {{$lang['step']}} # 2 = 
                                    <span class="quadratic_fraction">
                                        <span class="num">{{$detail['upr']}}</span>
                                        <span>{{$detail['div']}}</span>
                                    </span>
                                </p>
                                @if($detail['g']!=1)
                                    <p class="mt-2">
                                        {{$lang['step']}} # 3 = 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$detail['upr']}} ÷ {{$detail['g']}}</span>
                                            <span>{{$detail['div']}} ÷ {{$detail['g']}}</span>
                                        </span>
                                    </p>
                                @endif
                                @if($detail['btm']=='1')
                                    <p class="mt-2">{{$lang['an']}} = {{$detail['uper']}}</p>
                                @else
                                    <p class="mt-2">
                                        {{$lang['an']}} =  
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$detail['uper']}}</span>
                                            <span>{{$detail['btm']}}</span>
                                        </span>
                                    </p>
                                @endif
                                @if ($detail['uper']>$detail['btm'] && $detail['btm']!='1')
                                    @php
                                        $bta=$detail['uper'] % $detail['btm'];
                                        $shi=floor($detail['uper'] / $detail['btm']);
                                    @endphp
                                    <p class="mt-2">
                                        {{$lang['or']}} = {{$shi}}
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$bta}}</span>
                                            <span>{{$detail['btm']}}</span>
                                        </span>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    
    @endisset
</form>