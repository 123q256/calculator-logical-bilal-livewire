<div>
 <form wire:submit.prevent="calculate">
    @php
        foreach(['from' => $from, 'a' => $a, 'b' => $b, 'c' => $c, 'h1' => $h1, 'k1' => $k1, 'x11' => $x11, 'y11' => $y11, 'x1' => $x1, 'y1' => $y1, 'x2' => $x2, 'y2' => $y2, 'x3' => $x3, 'y3' => $y3, 'axis' => $axis] as $key => $val) {
            $_POST[$key] = $val;
        }
    @endphp


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="from" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" wire:model.live="from" id="from">
                        <option value="1">{{$lang['2']}}</option>
                        <option value="2" >{{$lang['3']}}</option>
                        <option value="3" >{{$lang['12']}}</option>
                        {{-- <option value="4">Vertex and focus</option>
                        <option value="5">Vertex and directrix</option>
                        <option value="6">Focus and directrix</option> --}}
                        <option value="7" >{{$lang['13']}}</option>
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
                            <input type="number" required step="any" wire:model.live="a" id="a" class="input" aria-label="input" />
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
                            <input type="number" required step="any" wire:model.live="b" id="b" class="input" aria-label="input" />
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
                            <input type="number" required step="any" wire:model.live="c" id="c" class="input" aria-label="input" />
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
                            <input type="number" required step="any" wire:model.live="h1" id="h1" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="k1" class="font-s-14 text-blue">k</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" wire:model.live="k1" id="k1" class="input" aria-label="input" />
                        </div>
                    </div>
                    <p class="col-span-12 text-center my-3 text-[14px]"><strong>Point P₁(x₁,y₁)</strong></p>
                    <div class="col-span-6">
                        <label for="x11" class="font-s-14 text-blue">x₁</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" wire:model.live="x11" id="x11" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="y11" class="font-s-14 text-blue">y₁</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" wire:model.live="y11" id="y11" class="input" aria-label="input" />
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
                            <input type="number" required step="any" wire:model.live="x1" id="x1" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="y1" class="font-s-14 text-blue">y₁</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" wire:model.live="y1" id="y1" class="input" aria-label="input" />
                        </div>
                    </div>
                    <p class="col-span-12 text-center my-3 text-[14px]"><strong>P₂(x₂,y₂)</strong></p>
                    <div class="col-span-6">
                        <label for="x2" class="font-s-14 text-blue">x₂</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" wire:model.live="x2" id="x2" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="y2" class="font-s-14 text-blue">y₂</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" wire:model.live="y2" id="y2" class="input" aria-label="input" />
                        </div>
                    </div>
                    <p class="col-span-12 text-center my-3 text-[14px]"><strong>P₃(x₃,y₃)</strong></p>
                    <div class="col-span-6">
                        <label for="x3" class="font-s-14 text-blue">x₃</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" wire:model.live="x3" id="x3" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="y3" class="font-s-14 text-blue">y₃</label>
                        <div class="w-full py-2">
                            <input type="number" required step="any" wire:model.live="y3" id="y3" class="input" aria-label="input" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['from']) && ($_POST['from'] === '3' || $_POST['from'] === '7') ? '':'hidden' }} axisInput">
                <label for="axis" class="font-s-14 text-blue">{{ $lang['14'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" wire:model.live="axis" id="axis">
                        <option value="x">{{$lang['15']}}</option>
                		<option value="y" >{{$lang['16']}}</option>
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
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
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
                                <div class="w-full md:w-[80%] lg:w-[80%] mt-4 mx-auto" 
                                     wire:key="graph-main-{{ rand() }}" 
                                     x-data="{
                                         initGraph() {
                                             if (typeof JXG === 'undefined') { setTimeout(() => this.initGraph(), 200); return; }
                                             this.$nextTick(() => {
                                                 const el = document.getElementById('box-main');
                                                 if (!el) return;
                                                 el.innerHTML = '';
                                                 const a = {{ eval('return '.$detail['a'].';') }};
                                                 const b = {{ eval('return '.$detail['b'].';') }};
                                                 const c = {{ eval('return '.$detail['c'].';') }};
                                                 const vx = (b * -1) / (2 * a);
                                                 const vy = (a * vx * vx) + (b * vx) + c;
                                                 let ymin = vy - 20;
                                                 let ymax = vy + 20;
                                                 if (a > 0) {
                                                     ymin = vy - 5;
                                                 } else {
                                                     ymax = vy + 5;
                                                 }
                                                 const board = JXG.JSXGraph.initBoard('box-main', { 
                                                     boundingbox: [vx - 15, ymax, vx + 15, ymin], 
                                                     axis: true, 
                                                     showCopyright: false 
                                                 });
                                                 board.create('functiongraph', [function(x){ return a*x*x + b*x + c; }], {strokeColor: '#13699E', strokeWidth: 2});
                                             });
                                         }
                                     }" 
                                     x-init="initGraph()"
                                     @chartUpdated.window="initGraph()"
                                     wire:ignore>
                                    <div id="box-main" class="jxgbox w-full rounded-lg" style="height: 350px; background-color: #f7f7f7; border: 1px solid #ddd;"></div>
                                </div>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraph.css" />
        <script type="text/javascript" charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraphcore.js"></script>
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body); window.MJrerender = function() { renderMathInElement(document.body); }"></script>

    @endpush
</form>

</div>
