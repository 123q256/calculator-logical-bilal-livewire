<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
        <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-3 lg:gap-3">
            @php
                if(!isset($detail)) {
                    $_POST['method'] = "lm";
                }
            @endphp
            <div class="col-span-12">
                <label for="x" class="label">{{$lang['1']}} {{$lang['2']}}:</label>
                <div class="w-full pt-2">
                    <textarea aria-label="textarea input" id="x" name="x" class="textareaInput" id="textarea" placeholder="10, 20, 30">{{ isset($_POST['x'])?$_POST['x']:'10, 20, 30' }}</textarea>
                </div>
            </div>
            <div class="col-span-12">
                <label for="method" class="label">{{$lang['3']}}:</label>
                <div class="w-full pt-2">
                    <select name="method" class="input" id="method" aria-label="select">
                        <option value="none">{{$lang[4]}}</option>
                        <option value="lm" {{ isset($_POST['method']) && $_POST['method']=='lm'?'selected':'' }}>{{$lang[5]}}</option>
                        <option value="Pf" {{ isset($_POST['method']) && $_POST['method']=='Pf'?'selected':'' }}>{{$lang[6]}}</option>
                        <option value="ea" {{ isset($_POST['method']) && $_POST['method']=='ea'?'selected':'' }}>{{$lang[7]}}</option>
                        <option value="bs" {{ isset($_POST['method']) && $_POST['method']=='bs'?'selected':'' }}>{{$lang[8]}}</option>
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
 {{-- result --}}
 <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
            
                    <div class="w-full mt-3">
                        <div class="w-full">
                            @if($_POST['method']=='none')
                                <div class="w-full text-center font-s-20">
                                    <p>{{$lang['40']}} {{$_POST['x']}}</p>
                                    <p class="my-3"><strong class="bg-white px-3 py-2 font-s-32 radius-10 text-blue">{{$detail['gcf']}}</strong></p>
                                </div>
                            @elseif($_POST['method']=='lm')
                                <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['40']}} {{$_POST['x']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['gcf']}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full font-s-15">
                                    <p class="mt-2"><strong>{{$lang['13']}}</strong></p>
                                    <p class="mt-2"><span class="text-blue">#1. </span> {{$lang['10']}}:</p>
                                    {!!$detail['sl']!!}
                                    <p class="mt-2"><span class="text-blue">#2. </span> {{$lang['11']}}: {{$detail['bl']}}</p>
                                    <p class="mt-2"><span class="text-blue">#3. </span> {{$lang['12']}}: {{$_POST['x']}}: {{$detail['gcf']}}</p>
                                </div>
                            @elseif($_POST['method']=='Pf')
                                <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['40']}} {{$_POST['x']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['gcf']}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full font-s-15">
                                    <p class="mt-2"><strong>{{$lang['13']}}</strong></p>
                                    <p class="mt-2"><span class="text-blue">#1. </span> {{$lang['14']}}:</p>
                                    {!!$detail['al']!!}
                                    <p class="mt-2"><span class="text-blue">#2. </span> {{$lang['15']}}: {{$detail['se']}} {{$detail['ss']}}</p>
                                    <p class="mt-2"><span class="text-blue">#3. </span> {{$lang['16']}}: {{$detail['gcf']}}</p>
                                    <p class="mt-2"><span class="text-blue">#4. </span> {{$lang['17']}} ({{$_POST['x']}}) {{$lang['18']}}: {{$detail['gcf']}}</p>
                                </div>
                            @elseif($_POST['method']=='ea')
                                <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['40']}} {{$_POST['x']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['gcf']}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full font-s-15">
                                    <p class="mt-2"><strong>{{$lang['19']}}</strong></p>
                                    <p class="mt-2"><span class="text-blue">#1. </span> {{$lang['20']}}: ({{$detail['sg']}})</p>
                                    <p class="mt-2"><span class="text-blue">#2. </span> {{$lang['21']}}: ({{$detail['sm']}}) {{$lang['22']}}</p>
                                    <p class="mt-2"><span class="text-blue">#3. </span> {{$lang['23']}}: {{$detail['i']}}</p>
                                    <p class="mt-2"><span class="text-blue">#4. </span> {{$lang['24']}}: {{$detail['si']}}</p>
                                    <p class="mt-2"><span class="text-blue">#5. </span> {{$lang['26']}}: {{$detail['gcf']}}</p>
                                    <p class="mt-2"><span class="text-blue">#6. </span> {{$lang['27']}}: ({{$_POST['x']}}) {{$lang['18']}}: {{$detail['gcf']}}</p>
                                </div>
                            @else
                                <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['40']}} {{$_POST['x']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['gcf']}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full font-s-15">
                                    <p class="mt-2"><strong>{{$lang['28']}}</strong></p>
                                    @php
                                        $arr=$detail['numbers'];
                                        sort($arr);
                                        $av = count($arr);
                                        $avc = '';
                                        foreach ($arr as $key => $value) {
                                            $avc.=" $value ";
                                        }
                                        $key1=$lang['29'];
                                        $key2=$lang['30'];
                                        echo "<p class='mt-2'> $key1 :</p><p class='mt-2'> ($avc) </p>";
                                        echo "<p class='mt-2'> $key2 = 1";
                                        $check="yes";
                                        $hcf=1;
                                        $loop=2;
                                        while ($av!=1 && $check=="yes") {
                                            $arr1=array();
                                            $even_check=true;
                                            $odd_check=true;
                                            foreach ($arr as $key => $value) {
                                                if ($value%2==0) {
                                                    $odd_check=false;
                                                }else{
                                                    $even_check=false;
                                                }
                                            }
                                            if ($even_check==true) {
                                                $loop++;
                                                $loop2=$loop++;
                                                $a=$lang['31'].": <br>";
                                                foreach ($arr as $key => $value) {
                                                    $val=$value/2;
                                                    $arr1[]=$val;
                                                    $a.=" $val, ";
                                                }
                                                $a.="<br> GCF = $hcf * 2";
                                                $hcf=$hcf*2;
                                                $a.="= $hcf ";
                                                echo "<p class='mt-2'>$a</p>";
                                            }elseif ($odd_check==true) {
                                                if ($arr[0]==1) {
                                                    $check="no";
                                                    $loop++;
                                                    $f1=$lang['32']." 1.<br>";
                                                    $f1.="GCF = $hcf * 1 = $hcf";
                                                    echo "<p class='mt-2'>$f1</p>";
                                                }else{
                                                    $loop++;
                                                    $loop2=$loop++;
                                                    $first=$arr[0];
                                                    $e1=$first.", ";
                                                    foreach ($arr as $key => $value) {
                                                        if ($key!=0) {
                                                            $val=($value-$first)/2;
                                                            $e=$lang['33']." $first, ".$lang['34']." $first ".$lang['35']." 2:";
                                                            $e.="($value - $first) / 2 =";
                                                            $e.=" $val ";
                                                            $e.="<br/>";
                                                            $e1.="$val, ";
                                                            $arr1[]=$val;
                                                        }
                                                    }
                                                    $e.=$e1;
                                                    echo "<p class='mt-2'>$e</p>";
                                                    $arr1[]=$first;
                                                }
                                            }else{
                                                $b=$lang['36'].":<br>";
                                                $even='no';
                                                foreach ($arr as $key => $value) {
                                                    if ($value%2==0) {
                                                        $val=$value/2;
                                                        $b.=" $val ";
                                                        if ($val%2==0) {
                                                            $even="yes";
                                                        }
                                                        $arr1[]=$val;
                                                    }else{
                                                        $b.=" $value ";
                                                        $arr1[]=$value;
                                                    }
                                                }
                                                while($even=='yes'){
                                                    $b.="<br/>";
                                                    $even='no';
                                                    $arr=$arr1;
                                                    $arr1=array();
                                                    foreach ($arr as $key => $value) {
                                                        if ($value%2==0) {
                                                            $val=$value/2;
                                                            $b.=" $val ";
                                                            if ($val%2==0) {
                                                                $even="yes";
                                                            }
                                                            $arr1[]=$val;
                                                        }else{
                                                            $b.=" $value ";
                                                            $arr1[]=$value;
                                                        }
                                                    }
                                                }
                                                echo "<p class='mt-2'>$b</p>";
                                            }
                                            $arr=$arr1;
                                            $av=count($arr);
                                            if ($av!=1 && $check=="yes") {
                                                $arr=array_unique($arr);
                                                sort($arr);
                                                $e2=$lang['37'].":<br>";
                                                foreach ($arr as $key => $value) {
                                                    $e2.=" $value ";
                                                }
                                                echo "<p class='mt-2'>$e2</p>";
                                            }
                                            $arr=array_unique($arr);
                                            sort($arr);
                                            $av=count($arr);
                                            if ($av==1 && $arr[0]!=1) {
                                                $d1=$lang['38']." $arr[0]. ".$lang['39'].":<br>";
                                                $d1.="GCF = $hcf * $arr[0]";
                                                $hcf=$arr[0]*$hcf;
                                                $d1.=" = $hcf";
                                            }
                                        }
                                    @endphp
                                    <p class="mt-2">{{$lang['27']}} ({{$_POST['x']}}) {{$lang['18']}}: {{$detail['gcf']}}</p>
                                </div>
                            @endif
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @endisset
</form>