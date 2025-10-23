<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @unless(isset($detail))


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 "><strong class="text-blue-700">{{ $lang['4'] }}</strong></div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m1" class="label">{!! $lang['5'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m1" id="m1" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name=[$lang['1'],"----------",$lang['2'],$lang['3']];
                                $val = ["m","male","female","male"];
                                optionsList($val,$name,isset(request()->m1)?request()->m1:'m');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m2" class="label">{!! $lang['6'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m2" id="m2" class="input">
                            @php
                                $name=[$lang['1'],"----------",$lang['7'],$lang['8'],$lang['9'],$lang['10'],$lang['11'],$lang['12']];
                                $val = ["other","other","white","black","hipansic","asian","amindian","other"];
                                optionsList($val,$name,isset(request()->m2)?request()->m2:'oth');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m3" class="label">{!! $lang['18'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m3" id="m3" class="input">
                            @php
                                $name=[$lang['1'],"----------",$lang['13'],$lang['14'],$lang['15'],$lang['16'],$lang['17']];
                                $val = ["00","0","2","1","0","-1","-3"];
                                optionsList($val,$name,isset(request()->m3)?request()->m3:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m5" class="label">{!! $lang['24'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m5" id="m5" class="input">
                            @php
                                $name=[$lang['1'],"----------","7-8 ".$lang['25'],"8-9 ".$lang['25'],"6-7 ".$lang['25'],$lang['26'],$lang['27']];
                                $val = ["00","0","1","0","0","-1","-2"];
                                optionsList($val,$name,isset(request()->m5)?request()->m5:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12  "><strong class="text-blue-700">{{ $lang['28'] }}</strong></div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m6" class="label">{!! $lang['29'] !!} (HDL):</label>
                    <div class="w-full py-2 relative">
                        <select name="m6" id="m6" class="input">
                            @php
                                $name = [$lang['1'],"----------",$lang['30']." 160 (< 3)"," 160-200 (3-4)"," 200-240 (4-5)"," 240-280 (5-6)",$lang['31']." 280 (> 6)"];
                                $val = ["00","0","2","1","-1","-2","-4"];
                                optionsList($val,$name,isset(request()->m6)?request()->m6:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m7" class="label">{!! $lang['32'] !!} ({!! $lang['33'] !!} / {!! $lang['34'] !!}):</label>
                    <div class="w-full py-2 relative">
                        <select name="m7" id="m7" class="input">
                            @php
                                $name = [$lang['1'],"----------",$lang['30']." 160 (< 3)"," 160-200 (3-4)"," 200-240 (4-5)"," 240-280 (5-6)",$lang['31']." 280 (> 6)"];
                                $val = ["00","0","2","1","-1","-2","-4"];
                                optionsList($val,$name,isset(request()->m7)?request()->m7:'005');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m8" class="label">{!! $lang['35'] !!}?:</label>
                    <div class="w-full py-2 relative">
                        <select name="m8" id="m8" class="input">
                            @php
                                $name = [$lang['1'],"----------",$lang['36'],$lang['37']." 10 years ".$lang['38'],$lang['39']." 10 years ago ",$lang['40'],$lang['41'],"1".$lang['42'],"2".$lang['43']];
                                $val = ["00","0","1","1","0","-1","-1","-3","-5"];
                                optionsList($val,$name,isset(request()->m8)?request()->m8:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m11" class="label">{!! $lang['84'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m11" id="m11" class="input">
                            @php
                                $name=[$lang['1'],"----------",$lang['85'],$lang['86'],$lang['87'],$lang['88'],$lang['89']];
                                $val = ["00","0","1","0","0","-1","-3"];
                                optionsList($val,$name,isset(request()->m11)?request()->m11:'001');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 ">
                    <label for="m12" class="label">{!! $lang['90'] !!} ({{ $lang['91'] }},{{ $lang['92'] }},{{ $lang['93'] }}):</label>
                    <div class="w-full py-2 relative">
                        <select name="m12" id="m12" class="input">
                            @php
                                $name=[$lang['1'],"----------"," 60 minutes ,".$lang['94']," 30 minutes ,".$lang['95']," 20-30 minutes,".$lang['96']." 3-5 ".$lang['97']," 10-20 minutes ,".$lang['98']." 1-2 ".$lang['97'],$lang['99']];
                                $val = ["00","0","2","1","0","-1","-2"];
                                optionsList($val,$name,isset(request()->m12)?request()->m12:'001');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12  "><strong class="text-blue-700">{{ $lang['100'] }}</strong></div>
                <div class="col-span-12 ">
                    <label for="m13" class="label">{!! $lang['101'] !!} ({{ $lang['102'] }},{{ $lang['103'] }} ,{{ $lang['104'] }} ):</label>
                    <div class="w-full py-2 relative">
                        <select name="m13" id="m13" class="input">
                            @php
                                $name=[$lang['1'],"----------",$lang['105'],$lang['106'],$lang['107'],$lang['108']];
                                $val = ["00","0","1","0","0","-1"];
                                optionsList($val,$name,isset(request()->m13)?request()->m13:'001');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m14" class="label">{!! $lang['109'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m14" id="m14" class="input">
                            @php
                                $name=[$lang['1'],"----------",$lang['110'],$lang['111'],$lang['112'],$lang['113'],$lang['114']];
                                $val = ["00","0","1","0","-1","-2","-3"];
                                optionsList($val,$name,isset(request()->m14)?request()->m14:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m16" class="label">{!! $lang['122'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m16" id="m16" class="input">
                            @php
                                $name=[$lang['1'],"----------","",$lang['123'],$lang['124'],$lang['125'],$lang['126'],$lang['127']];
                                $val = ["00","0","1","0","-1","-2","-3"];
                                optionsList($val,$name,isset(request()->m16)?request()->m16:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m17" class="label">{!! $lang['128'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m17" id="m17" class="input">
                            @php
                                $name=[$lang['1'],"----------",$lang['129'],$lang['130'],$lang['131'],$lang['132'],$lang['133'],$lang['134']];
                                $val = ["00","0","1","0","0","-1","-2","-4"];
                                optionsList($val,$name,isset(request()->m17)?request()->m17:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m18" class="label">{!! $lang['135'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m18" id="m18" class="input">
                            @php
                                $name=[$lang['1'],"----------",$lang['136'],$lang['137'],$lang['138'],$lang['139'],$lang['140']];
                                $val = ["00","0","1","0","-1","-2","-3"];
                                optionsList($val,$name,isset(request()->m18)?request()->m18:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 "><strong class="text-blue-700">{{ $lang['141'] }} ({{ $lang['142'] }})</strong></div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m19" class="label">{!! $lang['143'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m19" id="m19" class="input">
                            @php
                                $name=[$lang['144'],"----------",$lang['145'],$lang['146'],$lang['147'],$lang['148'],$lang['149']];
                                $val = ["00","0","1","0","-1","-2","-4"];
                                optionsList($val,$name,isset(request()->m19)?request()->m19:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m20" class="label">{!! $lang['150'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m20" id="m20" class="input">
                            @php
                                $name=[$lang['144'],"----------",$lang['151'],$lang['152']."5 years ago",$lang['153']."30 years old",$lang['154'],$lang['155']."35 years old"];
                                $val = ["0","00","1","0","0","-2","-3"];
                                optionsList($val,$name,isset(request()->m20)?request()->m20:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 "><strong class="text-blue-700">{{ $lang['156'] }}</strong></div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m21" class="label">{!! $lang['157'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m21" id="m21" class="input">
                            @php
                                $name=[$lang['1'],"----------",$lang['158'],$lang['159'],$lang['160'],$lang['161'],$lang['162']];
                                $val = ["00","0","1","0","-1","-2","-3"];
                                optionsList($val,$name,isset(request()->m21)?request()->m21:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m22" class="label">{!! $lang['163'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m22" id="m22" class="input">
                            @php
                                $name = [$lang['1'],"----------","3".$lang['164'],"2".$lang['165'],$lang['166'],$lang['167']];
                                $val = ["00","0","1","0","-1","-3"];
                                optionsList($val,$name,isset(request()->m22)?request()->m22:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m23" class="label">{!! $lang['174'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m23" id="m23" class="input">
                            @php
                                $name=[$lang['1'],"----------","5".$lang['175'],"From 2 - 4".$lang['176'],$lang['159']."1".$lang['177'],$lang['178']];
                                $val = ["00","0","1","0","-1","-1"];
                                optionsList($val,$name,isset(request()->m23)?request()->m23:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m24" class="label">{!! $lang['179'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m24" id="m24" class="input">
                            @php
                                $name=[$lang['1'],"----------",$lang['180'],$lang['181'],$lang['182'],$lang['183'],$lang['184'],$lang['185']];
                                $val = ["00","0","1","0","0","0","-1","-2"];
                                optionsList($val,$name,isset(request()->m24)?request()->m24:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 "><strong class="text-blue-700">{{ $lang['198'] }}</strong></div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m27" class="label">{!! $lang['199'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m27" id="m27" class="input">
                            @php
                                $name=[$lang['1'],"----------",$lang['200'],$lang['201'],$lang['202'],$lang['203'],$lang['204']];
                                $val = ["00","0","1","0","-1","-2","-3"];
                                optionsList($val,$name,isset(request()->m27)?request()->m27:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m28" class="label">{!! $lang['211'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m28" id="m28" class="input">
                            @php
                                $name=[$lang['1'],"----------",$lang['212'],$lang['213'],$lang['214'],$lang['215'],$lang['216']];
                                $val = ["00","0","1","0","-1","-2","-3"];
                                optionsList($val,$name,isset(request()->m28)?request()->m28:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m30" class="label">{!! $lang['205'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m30" id="m30" class="input">
                            @php
                                $name=[$lang['1'],"----------",$lang['206'],$lang['207'],$lang['208'],$lang['209'],$lang['210']];
                                $val = ["00","0","1","0","-1","-2","-3"];
                                optionsList($val,$name,isset(request()->m30)?request()->m30:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m31" class="label">{!! $lang['168'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m31" id="m31" class="input">
                            @php
                                $name=[$lang['1'],"----------",$lang['169'],$lang['170'],$lang['171'],$lang['172'],$lang['173']];
                                $val = ["00","0","2","1","0","-1","-3"];
                                optionsList($val,$name,isset(request()->m31)?request()->m31:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 "><strong class="text-blue-700">{{ $lang['55'] }}</strong></div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m34" class="label">{!! $lang['56'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m34" id="m34" class="input">
                            @php
                                $name=[$lang['1'],"----------",$lang['57']."11.000km/year","11.000-24.000km/year","24.000-32.000km/year",$lang['58']."32.000 km/year"];
                                $val = ["00","0","1","0","-1","-2"];
                                optionsList($val,$name,isset(request()->m34)?request()->m34:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m35" class="label">{!! $lang['51'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m35" id="m35" class="input">
                            @php
                                $name=[$lang['1'],"----------",$lang['52'],$lang['54']."75%",$lang['53'],$lang['41']." (25%)",$lang['46']];
                                $val = ["00","0","1","0","-1","-2","-4"];
                                optionsList($val,$name,isset(request()->m35)?request()->m35:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 ">
                    <label for="m36" class="label">{!! $lang['45'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="m36" id="m36" class="input">
                            @php
                                $name=[$lang['1'],"----------",$lang['46'],$lang['47'],$lang['48'],$lang['49'],$lang['50']];
                                $val = ["00","0","1","0","-1","-1","-2"];
                                optionsList($val,$name,isset(request()->m36)?request()->m36:'00');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="age" class="label">{!! $lang['44'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->age)?request()->age:'' }}" />
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
    @endunless
    @isset($detail)
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full md:w-[80%] lg:w-[80%]">
                        <div class="flex flex-wrap justify-between">
                            <div>
                                <p>{{ $lang['223'] }}</p>
                                <p class="text-[28px]"><strong class="text-green-700">{{ $detail['typ'] }}</strong></p>
                            </div>
                            <div class="lg:border-r-2 md:border-r-2">&nbsp;</div>
                            <div>
                                <p>{{ $lang['224'] }}</p>
                                <p class="text-[28px]"><strong class="text-green-700">{{ $detail['exp'] }}</strong></p>
                            </div>
                            <div class="lg:border-r-2 md:border-r-2">&nbsp;</div>
                            <div>
                                <p>{{ $lang['225'] }}</p>
                                <p class="text-[28px]"><strong class="text-green-700">{{ $detail['bio'] }}</strong></p>
                            </div>
                        </div>
                        <p class="text-[18px] mt-3"><strong class="text-blue-700">{{ $lang['233'] }} (Years)</strong></p>
                        <div class="w-full md:w-[60%] lg:w-[60%] overflow-auto">
                            <table class="w-full" cellspacing="0">
                                <tr>
                                <td class="border-b py-2">{{ $lang['226'] }}</sub></td>
                                <td class="border-b py-2"><strong>{{ $detail['per'] }}</strong></td>
                                </tr>
                                <tr>
                                <td class="border-b py-2">{{ $lang['227'] }}</td>
                                <td class="border-b py-2"><strong>{{ $detail['med'] }}</strong></td>
                                </tr>
                                <tr>
                                <td class="border-b py-2">{{ $lang['228'] }}</td>
                                <td class="border-b py-2"><strong>{{ $detail['cad'] }}</strong></td>
                                </tr>
                                <tr>
                                <td class="border-b py-2">{{ $lang['229'] }}</td>
                                <td class="border-b py-2"><strong>{{ $detail['nut'] }}</strong></td>
                                </tr>
                                <tr>
                                <td class="border-b py-2">{{ $lang['230'] }}</td>
                                <td class="border-b py-2"><strong>{{ $detail['psychT'] }}</strong></td>
                                </tr>
                                <tr>
                                <td class="border-b py-2">{{ $lang['231'] }}</td>
                                <td class="border-b py-2"><strong>{{ $detail['saf'] }}</strong></td>
                                </tr>
                                <tr>
                                <td class="border-b py-2">{{ $lang['232'] }} =</td>
                                <td class="border-b py-2"><strong>{{ $detail['tot'] }}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 text-center my-[30px]">
                        <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                            @if (app()->getLocale() == 'en')
                                RESET
                            @else
                                {{ $lang['reset'] ?? 'RESET' }}
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        <script>
        </script>
    @endpush
</form>