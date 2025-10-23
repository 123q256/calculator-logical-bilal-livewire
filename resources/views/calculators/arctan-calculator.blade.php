<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="arctan" class="font-s-14 text-blue">{{$lang[1]}}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="arctan" id="arctan" class="input" value="{{ isset($_POST['arctan'])?$_POST['arctan']:'45' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="round" class="font-s-14 text-blue">{{$lang[2]}}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="round" min="0" max="15" id="round" class="input" value="{{ isset($_POST['round'])?$_POST['round']:'5' }}" aria-label="input"/>
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
                        <div class="cw-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['3']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['angle']}}°</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['4']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['rad']}} rad</td>
                                </tr>
                            </table>
                        </div>
                        <p class="mt-3 text-[18px]"><strong>{{ $lang['5'] }}</strong></p>
                        <div class="cw-full md:w-[60%] lg:w-[60%]  mt-3">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="40%">arctan ({{$_POST['arctan']}})</td>
                                    <td class="py-2 border-b"><strong>{{$detail['gon']}} (gradians)</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%">arctan ({{$_POST['arctan']}})</td>
                                    <td class="py-2 border-b"><strong>{{$detail['tr']}} (turns)</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%">arctan ({{$_POST['arctan']}})</td>
                                    <td class="py-2 border-b"><strong>{{$detail['arcmin']}} (minutes of)</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%">arctan ({{$_POST['arctan']}})</td>
                                    <td class="py-2 border-b"><strong>{{$detail['arcsec']}} (seconds of)</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%">arctan ({{$_POST['arctan']}})</td>
                                    <td class="py-2 border-b"><strong>{{$detail['mrad']}} (miliradians)</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%">arctan ({{$_POST['arctan']}})</td>
                                    <td class="py-2 border-b"><strong>{{$detail['urad']}} (microradians)</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%">arctan ({{$_POST['arctan']}})</td>
                                    <td class="py-2 border-b"><strong>{{$detail['pirad']}} (π radians)</strong></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 font-s-16 mt-3">
                            <p><strong>{{$lang[6]}}</strong></p>
                            <p class="mt-2">arctan {{$_POST['arctan']}} = tan<sup class="font-s-14">-1</sup> {{$_POST['arctan']}} = {{$detail['deg']}}° {{$detail['min']}}' {{$detail['sec']}}"</p>
                            <p class="mt-2">= {{$detail['angle']}} + k * 180° (k = -1,0,1,...)</p>
                            <p class="mt-2">= 
                                @php
                                    $ans=$detail['angle']+(-1)*180;
                                    $ans1=$detail['angle']+0*180;
                                    $ans2=$detail['angle']+1*180;
                                    echo round($ans,$_POST['round']).'°, '.round($ans1,$_POST['round']).'°, '.round($ans2,$_POST['round']).'°, ...';
                                @endphp
                            </p>
                            <p class="mt-2">=  {{$detail['rad']}} rad + k * π (k = -1,0,1,...)</p>
                            <p class="mt-2">= 
                                @php
                                    $rad=$detail['rad']/pi();
                                    $ans3=$rad+(-1);
                                    $ans4=$rad+0;
                                    $ans5=$rad+1;
                                    echo round($ans3,$_POST['round']).'π, '.round($ans4,$_POST['round']).'π, '.round($ans5,$_POST['round']).'π, ...';
                                @endphp
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>