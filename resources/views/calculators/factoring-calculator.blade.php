

<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           @php $request = request(); @endphp

           <div class="col-12 col-lg-9 mx-auto mt-2  w-full">
            <input type="hidden" name="type" value="{{ isset($request->type) && $request->type === 'factor' ? 'factor':'factoring' }}" id="type">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  tab {{ isset($request->type) && $request->type === 'factor' ? '':'tagsUnit' }}" id="imperial" data-value="factoring">
                            {{ $lang['12'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tab {{ isset($request->type) && $request->type === 'factor' ? 'tagsUnit':'' }}" id="metric" data-value="factor">
                            {{ $lang['11'] }}
                    </div>
                </div>
            </div>
        </div>

            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 {{ isset($request->type) && $request->type === 'factor' ? 'hidden':'' }} factoringInput">
                    <label for="eq" class="text-[14px] text-blue">{{$lang[13]}}</label>
                    <div class="w-100 py-2">
                        <input type="text" name="eq" id="eq" class="input" value="{{ isset($request->eq)?$request->eq:'x^2-6x+8' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 {{ isset($request->type) && $request->type === 'factor' ? '':'hidden' }} factorInput">
                    <label for="num1" class="text-[14px] text-blue">{{$lang[1]}}:</label>
                    <div class="w-100 py-2">
                        <input type="number" max="10000000" name="num1" id="num1" class="input" value="{{ isset($request->num1)?$request->num1:'12' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 {{ isset($request->type) && $request->type === 'factor' ? '':'hidden' }} factorInput">
                    <label for="num2" class="text-[14px] text-blue">{{$lang[2]}}:</label>
                    <div class="w-100 py-2">
                        <input type="number" max="10000000" name="num2" id="num2" class="input" value="{{ isset($request->num2)?$request->num2:'8' }}" aria-label="input"/>
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
                        @php
                        @endphp
                        @if($detail['submit']==='factoring')
                            @if(($detail['eq_degree'] === "2") && ($detail['c'] != "0"))
                                <div class="col-lg-6 mt-2">
                                    <table class="w-100 text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="40%"><strong>{{ $lang['16'] }}</strong></td>
                                            <td class="py-2 border-b">\( {{$detail['factors']}} \)</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full font-s-16">
                                    @if(!isset($detail['pair1']) && !isset($detail['pair2']))
                                        <p class="mt-3">This trinomial cannot be factorized into linear binomials with integer coefficients.</p>
                                    @endif
                                    <p class="mt-3"><strong>{{$lang['17']}}</strong></p>
                                    @if(isset($detail['pair1']) && isset($detail['pair2']))
                                        <p class="mt-3">\( {{ $detail['eq_enter']." = ".$detail['factors'] }} \)</p>
                                    @endif
                                    <p class="mt-3">{{$lang[18]}}:</p>
                                    <p class="mt-3">
                                        {{$lang[19]}}
                                        a = {{$detail['a']}} , b = {{$detail['b']}}, c = {{$detail['c']}}
                                    </p>
                                    <p class="mt-3">{{$lang[20]}}</p>
                                    <p class="mt-3">{{$lang[21]}}.</p>
                                    <p class="mt-3">
                                        {{$lang[22]}} |ac| = |{{$detail['a']}} * {{ ($detail['c'] < 0) ? "(".$detail['c'].")" : $detail['c'] }}| = {{ ($detail['a'] * $detail['c']) }}. {{$lang[23]}} {{ count($detail['divisors_ans']) }}  {{$lang[24]}}  {{ ($detail['a'] * $detail['c']) }}:
                                        @php
                                            $develop = 0;
                                            foreach ($detail['divisors_ans'] as $value) {
                                                echo $value;
                                                if(++$develop !== count($detail['divisors_ans'])) {
                                                    echo ",";
                                                }
                                            }
                                        @endphp
                                    </p>
                                    <p class="mt-3">{{$lang[25]}}</p>
                                    <p class="mt-3">{{$lang[26]}} {{ ($detail['a'] * $detail['c']) }}</p>
                                    @foreach ($detail['step2_array_first'] as $key => $value)
                                        <p class="mt-3">
                                            {{ "±".$value." * ±".$detail['step2_array_second'][$key]." = ".$detail['step2_ans_array'][$key] }}
                                        </p>
                                    @endforeach
                                    <p class="mt-3">{{$lang[27]}}</p>
                                    <p class="mt-3">
                                        {{$lang[28]}}  * {{ count($detail['step2_ans_array']) }} = {{ (2 * count($detail['step2_ans_array'])) }}  {{$lang[29]}}   b =  {{$detail['b']}}
                                    </p>
                                    @foreach($detail['step3_array_first'] as $key => $value)
                                        <p class="mt-3">
                                            @php
                                                if ($detail['c'] < 0) {
                                                    if ($detail['step3_array_second'][$key] < 0) {
                                                        echo $value." + ".($detail['step3_array_second'][$key] * (-1))." = ".$detail['step3_ans_array'][$key];
                                                    } else {
                                                        echo $value." - ".$detail['step3_array_second'][$key]." = ".$detail['step3_ans_array'][$key];
                                                    }
                                                    
                                                } else {
                                                    if ($value < 0) {
                                                        echo $value.$detail['step3_array_second'][$key]." = ".$detail['step3_ans_array'][$key];
                                                    } else {
                                                        echo $value." + ".$detail['step3_array_second'][$key]." = ".$detail['step3_ans_array'][$key];
                                                    }
                                                }
                                            @endphp
                                        </p>
                                    @endforeach
                                    @if(isset($detail['pair1']) && isset($detail['pair2']))
                                        <p class="mt-3">
                                            {{$lang[30]}} 
                                            @php
                                                if ($detail['c'] < 0) {
                                                    if ($detail['pair2'] < 0) {
                                                        echo $detail['pair1']." + ".($detail['pair2'] * (-1))." = ".($detail['pair1']-$detail['pair2']);
                                                    } else {
                                                        echo $detail['pair1']." - ".$detail['pair2']." = ".($detail['pair1']-$detail['pair2']);
                                                    }
                                                } else {
                                                    if ($detail['pair2'] < 0) {
                                                        echo $detail['pair1'].$detail['pair2']." = ".($detail['pair1']+$detail['pair2']);
                                                    }else{
                                                        echo $detail['pair1']." + ".$detail['pair2']." = ".($detail['pair1']+$detail['pair2']);
                                                    }
                                                }
                                            @endphp
                                        </p>
                                        <p class="mt-3">{{$lang[31]}}</p>
                                        <p class="mt-3">
                                            {{$lang[32]}} 
                                            @php
                                                if ($detail['c'] < 0) {
                                                    if ($detail['pair2'] < 0) {
                                                        echo ($detail['pair1']-$detail['pair2']).$detail['variable_ans']." as ".$detail['pair1'].$detail['variable_ans']." + ".($detail['pair2'] * (-1)).$detail['variable_ans'];
                                                    } else {
                                                        echo ($detail['pair1']-$detail['pair2']).$detail['variable_ans']." as ".$detail['pair1'].$detail['variable_ans']." - ".$detail['pair2'].$detail['variable_ans'];
                                                    }
                                                } else {
                                                    if ($detail['pair2'] < 0) {
                                                        echo ($detail['pair1']+$detail['pair2']).$detail['variable_ans']." as ".$detail['pair1'].$detail['variable_ans'].$detail['pair2'].$detail['variable_ans'];
                                                    }else{
                                                        echo ($detail['pair1']+$detail['pair2']).$detail['variable_ans']." as ".$detail['pair1'].$detail['variable_ans']." + ".$detail['pair2'].$detail['variable_ans'];
                                                    }
                                                }
                                            @endphp
                                        </p>
                                        <p class="mt-3">{{$lang[33]}}</p>
                                        <p class="mt-3">\( {{ $detail['eq_enter']}} \)</p>
                                        <p class="mt-3">{{$lang[34]}}</p>
                                        <p class="mt-3">
                                            \(
                                                @php
                                                    // echo $detail['x'].$detail['variable_ans']."^2";
                                                    echo $detail['variable_ans']."^2";
                                                    if ($detail['c'] < 0) {
                                                        if ($detail['pair2'] < 0) {
                                                            echo $detail['pair1'].$detail['variable_ans']." + ".($detail['pair2'] * (-1)).$detail['variable_ans'];
                                                        } else {
                                                            echo $detail['pair1'].$detail['variable_ans']." - ".$detail['pair2'].$detail['variable_ans'];
                                                        }
                                                        echo $detail['c'];
                                                    } else {
                                                        if ($detail['pair2'] < 0) {
                                                            echo $detail['pair1'].$detail['variable_ans'].$detail['pair2'].$detail['variable_ans'];
                                                        }else{
                                                            echo $detail['pair1'].$detail['variable_ans']." + ".$detail['pair2'].$detail['variable_ans'];
                                                        }
                                                        echo "+".$detail['c'];
                                                    } 
                                                @endphp 
                                            \)
                                        </p>
                                        <p class="mt-3">{{$lang[35]}}</p>
                                        <p class="mt-3">{{$lang[36]}}:</p>
                                        <p class="mt-3">\( {{ $detail['factors']}} \)</p>
                                    @else
                                        <p class="mt-3">{{$lang[37]}} {{ $detail['b']}}</p>
                                        <p class="mt-3">{{$lang[38]}}.</p>
                                        <p class="mt-3">{{$lang[39]}}</p>
                                        <p class="mt-3">{{$lang[40]}}</p>
                                        <p class="mt-3">\( b^2-4ac = {{ $detail['square'] }} \) </p>
                                        <p class="mt-3">{{$lang[41]}}  {{ ($detail['square'] < 0) ? "$lang[42]" : "$lang[43]"  }}, {{$lang[44]}}.</p>
                                    @endif
                                </div>
                            @else
                                <div class="w-full text-center text-[20px]">
                                    <p>l{{$lang[16]}}</p>
                                    <p class="my-3"><strong class="bg-white px-3 py-2 font-s-32 radius-10 text-blue">\( {{$detail['factors']}} \)</strong></p>
                                </div>
                            @endif
                        @else
                            @if(is_numeric($request->num1))
                                <div class="w-full text-[16px]">
                                    <p class="mt-3 text-[18px]"><strong>{!! $lang["3"]." <span class='total_num1'></span> ".$lang["4"]." ".$request->num1 !!}</strong></p>
                                    <p class="mt-3 total_nums1">
                                        @php
                                            if ($request->num1 < 0) {
                                                $absVl = abs($request->num1);
                                                for ($i1=1; $i1 <= $absVl ; $i1++) {
                                                    if ($absVl%$i1 === 0) {
                                                        if ($i1 != $absVl) {
                                                            $absV .= $i1.", ";
                                                            $absV1 .= "-".$i1.", ";
                                                        } else {
                                                            $absV .= $i1;
                                                            $absV1 .=  "-".$i1;
                                                        }
                                                    }
                                                }
                                                echo $absV . "<br />";
                                                echo $absV1;
                                            } else {
                                                for ($i1=1; $i1 <= $request->num1 ; $i1++) {
                                                    if ($request->num1%$i1 === 0) {
                                                        if ($i1 != $request->num1) {
                                                            echo "$i1, ";
                                                        } else {
                                                            echo "$i1";
                                                        }
                                                    }
                                                }
                                            }
                                        @endphp
                                    </p>
                                    @if($request->num1 > 0)
                                        <p class="mt-3">
                                            {{$lang["5"]." ".$lang["4"]." ".$request->num1}}
                                        </p>
                                        <p class="mt-3">
                                            {{$detail["Factors1"]}}
                                        </p>
                                        <p class="mt-3">
                                            {{$lang["6"]." ".$lang["4"]." ".$request->num1}}
                                        </p>
                                        <p class="mt-3">
                                            @php
                                                $csv1 = explode(" × ", $detail["Factors1"]);
                                                $exp1 = array_count_values($csv1);
                                                $end1 = count($exp1);
                                                $f1 = 1;
                                                foreach ($exp1 as $key => $value) {
                                                    if ($f1 != $end1) {
                                                        echo $key.'<sup class="text-[14px]">'.$value.'</sup> x ';
                                                    }else{
                                                        echo $key.'<sup class="text-[14px]">'.$value.'</sup>';
                                                    }
                                                    $f1++;
                                                }
                                            @endphp
                                        </p>
                                    @endif
                                    <p class="mt-3">{{$lang["7"]." ".$request->num1. ":"}}</p>
                                    <p class="mt-3">
                                        @php
                                            if ($request->num1 < 0) {
                                                $mnsNum = abs($request->num1);
            
                                                for ($g1 = 1; $g1 <= $mnsNum ; $g1++) {
                                                    if ($mnsNum%$g1 === 0) {
                                                        if ($g1 != $mnsNum) {
                                                            $mnsNum1 .= $g1.", ";
                                                            $mnsNum2 .= "-".$g1.", ";
                                                        } else {
                                                            $mnsNum1 .= "$g1";
                                                            $mnsNum2 .= "-"."$g1";
                                                        }
                                                    }
                                                }
            
                                                $mnsNum1Ar = explode(", ",$mnsNum1);
                                                $mnsNum2Ar = array_reverse(explode(", ",$mnsNum2));
                                                foreach($mnsNum1Ar as $h1 => $key) {
                                                    echo "(" .$key. ", " .$mnsNum2Ar[$h1]. ") ";
                                                }
                                            } else {
                                                $sAr1 = "";
                                                for ($g1 = 1; $g1 <= $request->num1 ; $g1++) {
                                                    if ($request->num1%$g1 === 0) {
                                                        if ($g1 != $request->num1) {
                                                            $sAr1 .= $g1.", ";
                                                        } else {
                                                            $sAr1 .= "$g1";
                                                        }
                                                    }
                                                }
                                                $sArr1 = explode(", ",$sAr1);
                                                $rArr1 = array_reverse($sArr1);
                                                $arraySize1 = count($sArr1);
                                                $lastIndex1 = $arraySize1 - 1;
                                                $middleIndex1 = ceil($lastIndex1 / 2);
                                                foreach($sArr1 as $h1 => $key) {
                                                    if (($h1 + 1) <= $middleIndex1) {
                                                        echo "(" .$key. ", " .$rArr1[$h1]. ") ";
                                                    }
                                                }
                                            }
                                        @endphp
                                    </p>
                                </div>
                            @endif
                            @if(is_numeric($request->num2))
                                <div class="w-full text-[16px]">
                                    <p class="mt-3 text-[18px]"><strong>{!! $lang["3"]." <span class='total_num2'></span> ".$lang["4"]." ".$request->num2 !!}</strong></p>
                                    <p class="mt-3 total_nums2">
                                        @php
                                            if ($request->num2 < 0) {
                                                $absVl2 = abs($request->num2);
                                                for ($i2=1; $i2 <= $absVl2 ; $i2++) {
                                                    if ($absVl2%$i2 === 0) {
                                                        if ($i2 != $absVl2) {
                                                            $absV22 .= $i2.", ";
                                                            $absV2 .= "-".$i2.", ";
                                                        } else {
                                                            $absV22 .= $i2;
                                                            $absV2 .=  "-".$i2;
                                                        }
                                                    }
                                                }
                                                echo $absV22 . "<br />";
                                                echo $absV2;
                                            } else {
                                                for ($i2=1; $i2 <= $request->num2 ; $i2++) {
                                                    if ($request->num2%$i2 === 0) {
                                                        if ($i2 != $request->num2) {
                                                            echo "$i2, ";
                                                        } else {
                                                            echo "$i2";
                                                        }
                                                    }
                                                }
                                            }
                                        @endphp
                                    </p>
                                    @if($request->num2 > 0)
                                        <p class="mt-3">{{$lang["5"]." ".$lang["4"]." ".$request->num2}}</p>
                                        <p class="mt-3">{{$detail["Factors2"]}}</p>
                                        <p class="mt-3">{{$lang["6"]." ".$lang["4"]." ".$request->num2}}</p>
                                        <p class="mt-3">
                                            @php
                                                $csv2 = explode(" × ", $detail["Factors2"]);
                                                $exp2 = array_count_values($csv2);
                                                $end2 = count($exp2);
                                                $f2 = 1;
                                                foreach ($exp2 as $key => $value) {
                                                    if ($f2 != $end2) {
                                                        echo $key.'<sup>'.$value.'</sup> x ';
                                                    }else{
                                                        echo $key.'<sup>'.$value.'</sup>';
                                                    }
                                                    $f2++;
                                                }
                                            @endphp 
                                        </p>
                                    @endif
                                    <p class="mt-3">{{$lang["7"]." ".$request->num2. ":"}}</p>
                                    <p class="mt-3">
                                        @php
                                            if ($request->num2 < 0) {
                                                $mnsNum2 = abs($request->num2);
            
                                                for ($g2 = 1; $g2 <= $mnsNum2 ; $g2++) {
                                                    if ($mnsNum2%$g2 === 0) {
                                                        if ($g2 != $mnsNum2) {
                                                            $mnsNum12 .= $g2.", ";
                                                            $mnsNum23 .= "-".$g2.", ";
                                                        } else {
                                                            $mnsNum12 .= "$g2";
                                                            $mnsNum23 .= "-"."$g2";
                                                        }
                                                    }
                                                }
            
                                                $mnsNum22Ar = explode(", ",$mnsNum12);
                                                $mnsNum21Ar = array_reverse(explode(", ",$mnsNum23));
                                                foreach($mnsNum22Ar as $h2 => $key) {
                                                    echo "(" .$key. ", " .$mnsNum21Ar[$h2]. ") ";
                                                }
            
                                            } else {
                                                $sAr2 = "";
                                                for ($g2 = 1; $g2 <= $request->num2 ; $g2++) {
                                                    if ($request->num2%$g2 === 0) {
                                                        if ($g2 != $request->num2) {
                                                            $sAr2 .= $g2.", ";
                                                        } else {
                                                            $sAr2 .= "$g2";
                                                        }
                                                    }
                                                }
                                                $sArr2 = explode(", ",$sAr2);
                                                $rArr2 = array_reverse($sArr2);
                                                $arraySize2 = count($sArr2);
                                                $lastIndex2 = $arraySize2 - 1;
                                                $middleIndex2 = ceil($lastIndex2 / 2);
                                                foreach($sArr2 as $h2 => $key) {
                                                    if (($h2 + 1) <= $middleIndex2) {
                                                        echo "(" .$key. ", " .$rArr2[$h2]. ") ";
                                                    }
                                                }
            
                                            }
                                        @endphp
                                    </p>
                                    @if(is_numeric($request->num1) && is_numeric($request->num2) && ($request->num1 > 0) && ($request->num2 > 0))
                                        <p class="mt-3">{!! $lang["3"]." <span class='comnFctr'></span> ".$lang["8"]." ".$request->num1." ".$lang["9"]." ".$request->num2." :" !!}</p>
                                        <p class="mt-3 comnFctr1">
                                            @php
                                                $nwArr = array_intersect($sArr1,$sArr2);
                                                $nwArrCunt = count($nwArr);
                                                foreach($nwArr as $keys => $val) {
                                                    if ($val != end($nwArr)) {
                                                        $val = $val.", ";
                                                    } else {
                                                        $val = $val;
                                                    }
                                                    echo $val;
                                                }
                                            @endphp
                                        </p>
                                    @endif
                                    <div class="grid grid-cols-12 gap-3">
                                        @if($request->num1 > 0)
                                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                                @if(is_numeric($request->num1))
                                                    <p class="mt-3 text-center">{{$lang["10"]." ".$request->num1}}</p>
                                                    <table class="w-[30%]  mx-auto text-[16px]">{!!$detail["tree1"]!!}</table>
                                                @endif
                                            </div>
                                        @endif
                                        @if($request->num2 > 0)
                                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                                @if(is_numeric($request->num2))
                                                    <p class="mt-3 text-center">{{$lang["10"]." ".$request->num2}}</p>
                                                    <table class="w-[30%]  mx-auto text-[16px]">{!!$detail["tree2"]!!}</table>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
    
    @endisset
    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        @if(isset($detail) && $detail['submit'] === "factor")
            <script>
                var trmNms = document.querySelector(".total_nums1").textContent.trim();
                if (trmNms.indexOf("-") === -1) {
                    document.querySelector(".total_num1").textContent = trmNms.split(",").length;
                } else {
                    document.querySelector(".total_num1").textContent = trmNms.split(",").length + 1;
                }
                var trmNms2 = document.querySelector(".total_nums2").textContent.trim();
                if (trmNms2.indexOf("-") === -1) {
                    document.querySelector(".total_num2").textContent = trmNms2.split(",").length;
                } else {
                    document.querySelector(".total_num2").textContent = trmNms2.split(",").length + 1;
                }
                document.querySelector(".comnFctr").textContent = document.querySelector(".comnFctr1").textContent.split(",").length;
            </script>
        @endif
        <script>
            document.querySelectorAll('.tab').forEach(function(tab) {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.tab').forEach(function(tab) {
                        tab.classList.remove('tagsUnit');
                    });
                    this.classList.add('tagsUnit');
                    let val = this.dataset.value;
                    document.getElementById('type').value = val;
                    if (val === 'factor') {
                        ['.factorInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                        ['.factoringInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                    } else {
                        ['.factorInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                        ['.factoringInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                    }
                });
            });
        </script>
    @endpush
</form>