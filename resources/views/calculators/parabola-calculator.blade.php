<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="from" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="from" id="from">
                        <option value="1">{{$lang['2']}}</option>
                        <option value="2" {{ isset($_POST['from']) && $_POST['from'] == '2' ? 'selected' : '' }}>{{$lang['3']}}</option>
                        <option value="3" {{ isset($_POST['from']) && $_POST['from'] == '3' ? 'selected' : '' }}>{{$lang['12']}}</option>
                        {{-- <option value="4">Vertex and focus</option>
                        <option value="5">Vertex and directrix</option>
                        <option value="6">Focus and directrix</option> --}}
                        <option value="7" {{ isset($_POST['from']) && $_POST['from'] == '7' ? 'selected' : '' }}>{{$lang['13']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['from']) && ($_POST['from'] === '3' || $_POST['from'] === '7') ? 'hidden':'' }} standardEquation">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12 text-center my-3 text-[14px]">
                        <strong id="changeText">
                            @if (isset($_POST['from']) && $_POST['from'] === '2')
                                {{$lang['3']}}: f(x) = a(x - h)² + k
                            @else
                                Standard Form: y = ax² + bx + c
                            @endif
                        </strong>
                    </p>
                    <div class="col-span-4">
                        <label for="a" class="font-s-14 text-blue">a</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" name="a" id="a" class="input" value="{{ isset($_POST['a']) ? $_POST['a'] : '2' }}" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="b" class="font-s-14 text-blue enter_b">
                            @if (isset($_POST['from']) && $_POST['from'] === '2')
                                h
                            @else
                                b
                            @endif
                        </label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" name="b" id="b" class="input" value="{{ isset($_POST['b']) ? $_POST['b'] : '-6' }}" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="c" class="font-s-14 text-blue enter_c">
                            @if (isset($_POST['from']) && $_POST['from'] === '2')
                                k
                            @else
                                c
                            @endif
                        </label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" name="c" id="c" class="input" value="{{ isset($_POST['c']) ? $_POST['c'] : '-13' }}" aria-label="input" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['from']) && $_POST['from'] === '3' ? '':'hidden' }} vertexPoints">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12 text-center my-3 text-[14px]"><strong>{{$lang['5']}} P(h,k)</strong></p>
                    <div class="col-span-6">
                        <label for="h1" class="font-s-14 text-blue">h</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" name="h1" id="h1" class="input" value="{{ isset($_POST['h1']) ? $_POST['h1'] : '3' }}" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="k1" class="font-s-14 text-blue">k</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" name="k1" id="k1" class="input" value="{{ isset($_POST['k1']) ? $_POST['k1'] : '4' }}" aria-label="input" />
                        </div>
                    </div>
                    <p class="col-span-12 text-center my-3 text-[14px]"><strong>Point P₁(x₁,y₁)</strong></p>
                    <div class="col-span-6">
                        <label for="x11" class="font-s-14 text-blue">x₁</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" name="x11" id="x11" class="input" value="{{ isset($_POST['x11']) ? $_POST['x11'] : '2' }}" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="y11" class="font-s-14 text-blue">y₁</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" name="y11" id="y11" class="input" value="{{ isset($_POST['y11']) ? $_POST['y11'] : '3' }}" aria-label="input" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['from']) && $_POST['from'] === '7' ? '':'hidden' }} threePoints">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12 text-center my-3 text-[14px]"><strong>P₁(x₁,y₁)</strong></p>
                    <div class="col-span-6">
                        <label for="x1" class="font-s-14 text-blue">x₁</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" name="x1" id="x1" class="input" value="{{ isset($_POST['x1']) ? $_POST['x1'] : '0' }}" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="y1" class="font-s-14 text-blue">y₁</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" name="y1" id="y1" class="input" value="{{ isset($_POST['y1']) ? $_POST['y1'] : '3' }}" aria-label="input" />
                        </div>
                    </div>
                    <p class="col-span-12 text-center my-3 text-[14px]"><strong>P₂(x₂,y₂)</strong></p>
                    <div class="col-span-6">
                        <label for="x2" class="font-s-14 text-blue">x₂</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" name="x2" id="x2" class="input" value="{{ isset($_POST['x2']) ? $_POST['x2'] : '1' }}" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="y2" class="font-s-14 text-blue">y₂</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" name="y2" id="y2" class="input" value="{{ isset($_POST['y2']) ? $_POST['y2'] : '2' }}" aria-label="input" />
                        </div>
                    </div>
                    <p class="col-span-12 text-center my-3 text-[14px]"><strong>P₃(x₃,y₃)</strong></p>
                    <div class="col-span-6">
                        <label for="x3" class="font-s-14 text-blue">x₃</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" name="x3" id="x3" class="input" value="{{ isset($_POST['x3']) ? $_POST['x3'] : '2' }}" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="y3" class="font-s-14 text-blue">y₃</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" name="y3" id="y3" class="input" value="{{ isset($_POST['y3']) ? $_POST['y3'] : '3' }}" aria-label="input" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['from']) && ($_POST['from'] === '3' || $_POST['from'] === '7') ? '':'hidden' }} axisInput">
                <label for="axis" class="font-s-14 text-blue">{{ $lang['14'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="axis" id="axis">
                        <option value="x">{{$lang['15']}}</option>
                		<option value="y" {{ isset($_POST['axis']) && $_POST['axis'] == 'y' ? 'selected' : '' }}>{{$lang['16']}}</option>
                    </select>
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
                            @if($_POST['axis']=='y')
                                <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><strong>{{$lang[4]}}</strong></td>
                                            <td class="py-2 border-b">
                                                \(
                                                    y = {{$detail['a']}}x^2 {{(($detail['b']>1)?'+'.$detail['b']:$detail['b'])}}x {{(($detail['c']>0)?'+'.$detail['c']:$detail['c'])}} 
                                                \)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><strong>{{$lang[3]}}</strong></td>
                                            <td class="py-2 border-b">
                                                \(
                                                    y = {{(($detail['a']!='1')?$detail['a']:'')}}(x {{(($detail['hf_']>1)?'-':'+')}} {{((is_numeric($detail['hf']))?abs($detail['hf']):'\\frac{'.abs($detail['h1']).'}{'.abs($detail['h2']).'}')}}  )^2 {{(($detail['kf_']>1)?'+':'-')}} {{((is_numeric($detail['kf']))?abs($detail['kf']):'\\frac{'.abs($detail['k1']).'}{'.abs($detail['k2']).'}')}}
                                                \)
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full md:w-[80%] lg:w-[80%] mt-2">                    
                                    <table class="w-full text-[16px]">
                                        <tr>
                                            <td class="py-2 border-b" width="50%">{{ $lang['5'] }}</td>
                                            <td class="py-2 border-b">
                                                \(
                                                    ({{((is_numeric($detail['kf']))?$detail['kf']:'\\frac{'.$detail['k1'].'}{'.$detail['k2'].'}')}},{{((is_numeric($detail['hf']))?$detail['hf']:'\\frac{'.$detail['h1'].'}{'.$detail['h2'].'}')}})
                                                \)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%">{{ $lang['6'] }}</td>
                                            <td class="py-2 border-b">
                                                \(
                                                    ( {{((is_numeric($detail['fuf']))?$detail['fuf']:'\\frac{'.$detail['fu1'].'}{'.$detail['fu2'].'}')}} , {{((is_numeric($detail['hf']))?$detail['hf']:'\\frac{'.$detail['h1'].'}{'.$detail['h2'].'}')}})
                                                \)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%">{{ $lang['7'] }}</td>
                                            <td class="py-2 border-b">\( 1 \)</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%">{{ $lang['8'] }}</td>
                                            <td class="py-2 border-b">
                                                \(
                                                    x = {{((is_numeric($detail['dirf']))?$detail['dirf']:'\\frac{'.$detail['dir1'].'}{'.$detail['dir2'].'}')}}
                                                \)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%">{{ $lang['9'] }}</td>
                                            <td class="py-2 border-b">
                                                \(
                                                    x = {{((is_numeric($detail['fuf']))?$detail['fuf']:'\\frac{'.$detail['fu1'].'}{'.$detail['fu2'].'}')}}
                                                \)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%">{{ $lang['10'] }}</td>
                                            <td class="py-2 border-b">
                                                \(
                                                    y = {{((is_numeric($detail['hf']))?$detail['hf']:'\\frac{'.$detail['h1'].'}{'.$detail['h2'].'}')}}
                                                \)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%">y-{{ $lang['11'] }}</td>
                                            <td class="py-2 border-b">
                                                \(
                                                    {{((isset($detail['x_inter1']))?' (0, '.$detail['x_inter1'].' ) , (0 , '.$detail['x_inter2'].')':'No y-'.$lang['11'])}} 
                                                \)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%">x-{{ $lang['11'] }}</td>
                                            <td class="py-2 border-b">
                                                \(
                                                    ({{$detail['y_inter']}} , 0)
                                                \)
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @else
                                <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><strong>{{$lang[4]}}</strong></td>
                                            <td class="py-2 border-b">
                                                \(
                                                    y = {{$detail['a']}}x^2 {{(($detail['b']>1)?'+'.$detail['b']:$detail['b'])}}x {{(($detail['c']>0)?'+'.$detail['c']:$detail['c'])}} 
                                                \)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><strong>{{$lang[3]}}</strong></td>
                                            <td class="py-2 border-b">
                                                \(
                                                    y = {{(($detail['a']!='1')?$detail['a']:'')}}(x {{(($detail['hf_']>1)?'-':'+')}} {{((is_numeric($detail['hf']))?abs($detail['hf']):'\\frac{'.abs($detail['h1']).'}{'.abs($detail['h2']).'}')}}  )^2 {{(($detail['kf_']>1)?'+':'-')}}
                                                {{((is_numeric($detail['kf']))?abs($detail['kf']):'\\frac{'.abs($detail['k1']).'}{'.abs($detail['k2']).'}')}} 
                                                \)
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full md:w-[80%] lg:w-[80%] mt-2">                    
                                    <table class="w-full text-[16px]">
                                        <tr>
                                            <td class="py-2 border-b" width="50%">{{ $lang['5'] }}</td>
                                            <td class="py-2 border-b">
                                                \(
                                                    ({{((is_numeric($detail['hf']))?$detail['hf']:'\\frac{'.$detail['h1'].'}{'.$detail['h2'].'}')}} , {{((is_numeric($detail['kf']))?$detail['kf']:'\\frac{'.$detail['k1'].'}{'.$detail['k2'].'}')}})
                                                \)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%">{{ $lang['6'] }}</td>
                                            <td class="py-2 border-b">
                                                \(
                                                    ({{((is_numeric($detail['hf']))?$detail['hf']:'\\frac{'.$detail['h1'].'}{'.$detail['h2'].'}')}} , {{((is_numeric($detail['fuf']))?$detail['fuf']:'\\frac{'.$detail['fu1'].'}{'.$detail['fu2'].'}')}})
                                                \)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%">{{ $lang['7'] }}</td>
                                            <td class="py-2 border-b">\( 1 \)</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%">{{ $lang['8'] }}</td>
                                            <td class="py-2 border-b">
                                                \(
                                                    y = {{((is_numeric($detail['dirf']))?$detail['dirf']:'\\frac{'.$detail['dir1'].'}{'.$detail['dir2'].'}')}}
                                                \)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%">{{ $lang['9'] }}</td>
                                            <td class="py-2 border-b">
                                                \(
                                                    y = {{((is_numeric($detail['fuf']))?$detail['fuf']:'\\frac{'.$detail['fu1'].'}{'.$detail['fu2'].'}')}}
                                                \)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%">{{ $lang['10'] }}</td>
                                            <td class="py-2 border-b">
                                                \(
                                                    x = {{((is_numeric($detail['hf']))?$detail['hf']:'\\frac{'.$detail['h1'].'}{'.$detail['h2'].'}')}}
                                                \)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%">x-{{ $lang['11'] }}</td>
                                            <td class="py-2 border-b">
                                                \(
                                                    {{((isset($detail['x_inter1']))?' ('.$detail['x_inter1'].' , 0 ) , ( '.$detail['x_inter2'].' , 0 )':'No x-'.$lang['11'])}} 
                                                \)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%">y-{{ $lang['11'] }}</td>
                                            <td class="py-2 border-b">
                                                \(
                                                    (0 , {{$detail['y_inter']}})
                                                \)
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            @if($detail['from']==3 || $detail['from']==7)
                                <div class="w-full text-[16px]">
                                    <p class="mt-2"><strong>Solution</strong></p>
                                    @if($detail['from']==3 && $detail['axis']=='x')
                                        @php
                                            $h=trim($_POST['h1']);
                                            $k=trim($_POST['k1']);
                                            $x11=trim($_POST['x11']);
                                            $y11=trim($_POST['y11']);
                                        @endphp
                                        <p class="mt-2">{{$lang['17']}}: \( P=({{$_POST['h1'].','.$_POST['k1']}}),Q=({{((is_numeric($detail['hf']))?$detail['hf']:'\\frac{'.$detail['h1'].'}{'.$detail['h2'].'}')}} , {{((is_numeric($detail['fuf']))?$detail['fuf']:'\\frac{'.$detail['fu1'].'}{'.$detail['fu2'].'}')}}) \)</p>
                                        <p class="mt-2">{{$lang['18']}} \( (h,k)\) is \( y=a(x-h)^2+k\)</p>
                                        <p class="mt-2">{{$lang['19']}} \( y=a(x-{{$h}})^2+{{$k}}\)</p>
                                        <p class="mt-2">{{$lang['20']}} \( ({{$_POST['x11'].','.$_POST['y11']}}): {{$y11}}=a({{$x11}}-{{$h}})^2+{{$k}}\)</p>
                                        <p class="mt-2">{{$lang['21']}} \( a={{$detail['a']}}\)</p>
                                    @elseif($detail['from']==3 && $detail['axis']=='y')
                                        @php
                                            $h=trim($_POST['k1']);
                                            $k=trim($_POST['h1']);
                                            $x11=trim($_POST['y11']);
                                            $y11=trim($_POST['x11']);
                                        @endphp
                                        <p class="mt-2">{{$lang['17']}}: \(P=({{$_POST['h1'].','.$_POST['k1']}}),Q=( {{((is_numeric($detail['fuf']))?$detail['fuf']:'\\frac{'.$detail['fu1'].'}{'.$detail['fu2'].'}')}} , {{((is_numeric($detail['hf']))?$detail['hf']:'\\frac{'.$detail['h1'].'}{'.$detail['h2'].'}')}})\)</p>
                                        <p class="mt-2">{{$lang['18']}} \((h,k)\) is \(x=a(y-k)^2+h\)</p>
                                        <p class="mt-2">{{$lang['19']}} \(x=a(y-{{$h}})^2+{{$k}}\)</p>
                                        <p class="mt-2">{{$lang['20']}} \(({{$_POST['x11'].','.$_POST['y11']}}): {{$y11}}=a({{$x11}}-{{$h}})^2+{{$k}}\)</p>
                                        <p class="mt-2">{{$lang['21']}} \(a={{$detail['a']}}\)</p>
                                    @endif
                    
                    
                                    @if($detail['from']==7 && $detail['axis']=='x')
                                        @php
                                            $x1=$_POST['x1'];
                                            $x2=$_POST['x2'];
                                            $x3=$_POST['x3'];
                                            $a1=pow($_POST['x1'], 2);
                                            $a2=pow($_POST['x2'], 2);
                                            $a3=pow($_POST['x3'], 2);
                                        @endphp
                                        <p class="mt-2">{{$lang['17']}}: \(P_1=({{$_POST['x1'].','.$_POST['y1']}}),P_2=({{$_POST['x2'].','.$_POST['y2']}}),P_3=({{$_POST['x3'].','.$_POST['y3']}})\)</p>
                                        <p class="mt-2">{{$lang['22']}} \(y = ax^2+bx+c\)</p>
                                        <p class="mt-2">{{$lang['23']}} \(({{$_POST['x1'].','.$_POST['y1']}})\), then \({{$_POST['y1']}} = {{(($a1!=1)?$a1:'')}}a + {{($x1!=1)?'('.$x1.')':''}} b + c\)</p>
                                        <p class="mt-2">{{$lang['23']}} \(({{$_POST['x2'].','.$_POST['y2']}})\), then \({{$_POST['y2']}} = {{(($a2!=1)?$a2:'')}}a + {{($x2!=1)?'('.$x2.')':''}} b + c\)</p>
                                        <p class="mt-2">{{$lang['23']}} \(({{$_POST['x3'].','.$_POST['y3']}})\), then \({{$_POST['y3']}} = {{(($a3!=1)?$a2:'')}}a + {{($x3!=1)?'('.$x3.')':''}} b + c\)</p>
                                        <p class="mt-2">{{$lang['24']}}
                                            \( \begin{cases}{{(($a1!=1)?$a1:'')}}a + {{($x1!=1)?'('.$x1.')':''}} b + c={{$_POST['y1']}}\\{{(($a2!=1)?$a2:'')}}a + {{($x2!=1)?'('.$x2.')':''}} b + c={{$_POST['y2']}}\\{{(($a3!=1)?$a2:'')}}a + {{($x3!=1)?'('.$x3.')':''}} b + c={{$_POST['y3']}}\end{cases}\)
                                        </p>
                                        <p class="mt-2">{{$lang['25']}} \( a = {{$detail['a']}},b = {{$detail['b']}},c = {{$detail['c']}}\)</p>
                                    @elseif($detail['from']==7 && $detail['axis']=='y')
                                        @php
                                            $x1=$_POST['x1'];
                                            $x2=$_POST['x2'];
                                            $x3=$_POST['x3'];
                                            $y1=$_POST['y1'];
                                            $y2=$_POST['y2'];
                                            $y3=$_POST['y3'];
                                            $a1=pow($_POST['y1'], 2);
                                            $a2=pow($_POST['y2'], 2);
                                            $a3=pow($_POST['y3'], 2);
                                        @endphp
                                        <p class="mt-2">{{$lang['17']}}: \(P_1=({{$_POST['x1'].','.$_POST['y1']}}),P_2=({{$_POST['x2'].','.$_POST['y2']}}),P_3=({{$_POST['x3'].','.$_POST['y3']}})\)</p>
                                        <p class="mt-2">{{$lang['22']}} \(x = ay^2+by+c\)</p>
                                        <p class="mt-2">{{$lang['23']}} \(({{$_POST['x1'].','.$_POST['y1']}})\), then \({{$_POST['x1']}} = {{(($a1!=1)?$a1:'')}}a + {{($y1!=1)?'('.$y1.')':''}} b + c\)</p>
                                        <p class="mt-2">{{$lang['23']}} \(({{$_POST['x2'].','.$_POST['y2']}})\), then \({{$_POST['x2']}} = {{(($a2!=1)?$a2:'')}}a + {{($y2!=1)?'('.$y2.')':''}} b + c\)</p>
                                        <p class="mt-2">{{$lang['23']}} \(({{$_POST['x3'].','.$_POST['y3']}})\), then \({{$_POST['x3']}} = {{(($a3!=1)?$a2:'')}}a + {{($y3!=1)?'('.$y3.')':''}} b + c\)</p>
                                        <p class="mt-2">{{$lang['24']}}
                                            \( \begin{cases}{{(($a1!=1)?$a1:'')}}a + {{($y1!=1)?'('.$y1.')':''}} b + c={{$_POST['x1']}}\\{{(($a2!=1)?$a2:'')}}a + {{($y2!=1)?'('.$y2.')':''}} b + c={{$_POST['x2']}}\\{{(($a3!=1)?$a2:'')}}a + {{($y3!=1)?'('.$y3.')':''}} b + c={{$_POST['x3']}}\end{cases}\)
                                        </p>
                                        <p class="mt-2">{{$lang['25']}} \(a = {{$detail['a']}},b = {{$detail['b']}},c = {{$detail['c']}}\)</p>
                                    @endif
                                </div>
                            @endif
                            @if($_POST['axis']!=='y')
                                <div id="box1" class="w-full md:w-[80%] lg:w-[80%] mt-4 mx-auto" style="height: 350px;"></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        @isset($detail)
            @if($_POST['axis']!=='y')
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script>
                    google.charts.load("current", {packages:["corechart"]});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data = new google.visualization.DataTable();
                        data.addColumn('number');
                        data.addColumn('number');
                        // Our central point, which will jiggle.
                        var a='{{eval('return '.$detail['a'].';')}}';
                        var b='{{eval('return '.$detail['b'].';')}}';
                        var c='{{eval('return '.$detail['c'].';')}}';
                        var firstx='{{($detail['b'] * (-1)) / ($detail['a']*2)}}';
                        firstx=parseFloat(firstx) + parseFloat(25);
                        for (var i = 0; i <=50 ; i++) {
                            var first_part=Math.pow(firstx,2)*a;
                            var second_part=b*firstx;
                            if (second_part<0 && c<0) {
                                var eq=first_part+' '+second_part+' '+c;
                            }
                            if (second_part<0 && c>=0) {
                                var eq=first_part+' '+second_part+' + '+c;
                            }
                            if (second_part>=0 && c<0) {
                                var eq=first_part+' + '+second_part+' '+c;
                            }
                            if (second_part>=0 && c>=0) {
                                var eq=first_part+' + '+second_part+' + '+c;
                            }
                            var yaxis=eval(eq);
                            yaxis=parseFloat(yaxis);
                            firstx=parseFloat(firstx);
                            data.addRow([firstx, yaxis]);
                            firstx=parseFloat(firstx)-1;
                        }
                        var options = {
                            legend: 'none',
                            colors: ['#13699E'],
                            lineWidth: 1,
                            pointSize: 5,
                            hAxis: {
                                title: 'x-axis'
                            },
                            vAxis: {
                                title: 'y-axis',
                                viewWindow: {
                                    min: -30,  // Set the minimum value for the Y-axis
                                    max: 30    // Set the maximum value for the Y-axis
                                }
                            },
                        };
                        var chart = new google.visualization.ScatterChart(document.getElementById('box1'));
                        chart.draw(data, options);
                        chart.draw(data, options);
                    }
                </script>
            @endif
        @endisset
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        <script>
            document.getElementById('from').addEventListener('change', function() {
                if (this.value === "1") {
                    document.getElementById('changeText').textContent = '{{$lang['2']}}: y = ax² + bx + c';
                    document.getElementsByClassName('enter_b')[0].textContent = 'b';
                    document.getElementsByClassName('enter_c')[0].textContent = 'c';
                    ['.standardEquation'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['.axisInput', '.vertexPoints', '.threePoints'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if(this.value === "2"){
                    document.getElementById('changeText').textContent = '{{$lang['3']}}: f(x) = a(x - h)² + k';
                    document.getElementsByClassName('enter_b')[0].textContent = 'h';
                    document.getElementsByClassName('enter_c')[0].textContent = 'k';
                    ['.standardEquation'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['.axisInput', '.vertexPoints', '.threePoints'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if(this.value === "3"){
                    ['.axisInput', '.vertexPoints'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['.standardEquation', '.threePoints'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else{
                    ['.axisInput', '.threePoints'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['.standardEquation', '.vertexPoints'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>
