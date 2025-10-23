<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">

            <p class="col-span-12 text-[14px]"><strong>{{$lang['1']}}. (2,8) {{$lang['2']}} [2,8] {{$lang['2']}} [2,8) {{$lang['2']}} (2,8]</strong></p>
            <div class="col-span-12">
                <label for="i" class="label">{{$lang['3']}}:</label>
                <div class="w-full py-2">
                    <input type="text" name="i" id="i" class="input" value="{{ isset($_POST['i'])?$_POST['i']:'(2,8]' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="x" class="label">x {{ $lang['4'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="x" id="x">
                        <option value="select">{{$lang['5']}}</option>
                        <option value="even" {{ isset($_POST['x']) && $_POST['x']=='even'?'selected':'' }}>{{$lang[6]}}</option>
                        <option value="odd" {{ isset($_POST['x']) && $_POST['x']=='odd'?'selected':'' }}>{{$lang[7]}}</option>
                        <option value="prime" {{ isset($_POST['x']) && $_POST['x']=='prime'?'selected':'' }}>{{$lang[8]}}</option>
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
                <div class="w-full  mt-3">
                    @php
                        $l=$detail['l'];
                        $r=$detail['r'];
                        if (isset($detail['lo_ro'])) {
                            $lo_ro=$detail['lo_ro'];
                        }
                        if (isset($detail['lo_rc'])) {
                            $lo_rc=$detail['lo_rc'];
                        }
                        if (isset($detail['lc_ro'])) {
                            $lc_ro=$detail['lc_ro'];
                        }
                        if (isset($detail['lc_rc'])) {
                            $lc_rc=$detail['lc_rc'];
                        }
                        $x=$_POST['x'];
                        $set=$detail['set'];
                        $set_len=count($set);
                        function is_prime($number){
                        if($number==='1'){
                        return false;
                        }
                        if($number==='2'){
                        return true;
                        }
                        $x1=sqrt($number);
                        $x1=floor($x1);
                        for($i = 2; $i <= $x1; ++$i){
                        if($number%$i===0){
                        break;
                        }
                        }
                        $i=(double)$i;
                        if($x1===$i-1){
                        return true;
                        }else{
                        return false;
                        }
                        }
                        if($x==='even'){
                            $even=array();
                        }elseif($x==='odd'){
                            $odd=array();
                        }elseif($x==='prime'){
                            $start=$set[0];
                            $end=end($set);
                            $prime=array();
                            for($i = $start; $i <= $end; $i++){
                            if(is_prime($i)){
                              $prime[].=$i;
                            }
                            }
                        }
                        foreach($set as $val){
                        if($val%2===0){
                          $even[]=$val;
                        }else{
                          $odd[]=$val;
                        }
                        }
                        if($x==='even'){
                            $set=$even;
                            $set_len=count($even);
                        }elseif($x==='odd'){
                            $set=$odd;
                            $set_len=count($odd);
                        }elseif($x==='prime'){
                            $set=$prime;
                            $set_len=count($prime);
                        }
                    @endphp
                    <div class="w-full">
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full font-s-18"> 
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang[9]}}</strong></td>
                                    <td class="py-2 border-b">
                                        {
                                            @php
                                                for($i=0; $i < $set_len; $i++){
                                                    $comma=', ';
                                                    if($i>$set_len-2){
                                                        $comma='';
                                                    }
                                                    echo $set[$i].$comma;
                                                }
                                            @endphp
                                        }
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <div class="steps">
                                <p class="mt-2"><strong>{{$lang['12']}}</strong></p>
                                <p class="mt-2">{{$lang['13']}}</p>
                                <p class="mt-2">
                                    { @php
                                        for($i=0; $i < $set_len; $i++){
                                            $comma=', ';
                                            if($i>$set_len-2){
                                                $comma='';
                                            }
                                            echo $set[$i].$comma;
                                        }
                                        @endphp }
                                </p>
                                <p class="mt-2">{{$lang['14']}}</p>
                                <p class="mt-2">
                                    @php
                                        if($x==='select'){
                                            $xs="";
                                        }else{
                                            $xs=", \space\space x \space is \space $x";
                                        }
                                        if(isset($lo_ro)){
                                            if($l>$r){
                                                echo "\( \{x \space | \space $r \lt x \lt $l $xs \} \)";
                                            }else{
                                                echo "\( \{x \space | \space $l \lt x \lt $r $xs \} \)";
                                            }
                                        }elseif(isset($lo_rc)){
                                            if($l<0 && $r<0){
                                                if($l>$r){
                                                    echo "\( \{x \space | \space $r \le x \lt $l $xs \} \)";
                                                }else{
                                                    echo "\( \{x \space | \space $l \lt x \le $r $xs \} \)";
                                                }
                                            }elseif($r<0 || $l>$r){
                                                echo "\( \{x \space | \space $r \le x \lt $l $xs \} \)";
                                            }else{
                                                echo "\( \{x \space | \space $l \lt x \le $r $xs \} \)";
                                            }
                                        }elseif(isset($lc_ro)){
                                            if($l<0 && $r<0){
                                                if($l>$r){
                                                    echo "\( \{x \space | \space $r \lt x \le $l $xs \} \)";
                                                }else{
                                                    echo "\( \{x \space | \space $l \le x \lt $r $xs \} \)";
                                                }
                                            }elseif($l<0 || $r>$l){
                                                echo "\( \{x \space | \space $l \le x \lt $r $xs \} \)";
                                            }else{
                                                echo "\( \{x \space | \space $r \lt x \le $l $xs \} \)";
                                            }
                                        }elseif(isset($lc_rc)){
                                            if($l>$r){
                                                echo "\( \{x \space | \space $r \le x \le $l $xs \} \)";
                                            }else{
                                                echo "\( \{x \space | \space $l \le x \le $r $xs \} \)";
                                            }
                                        }
                                    @endphp
                                </p>
                                <p class="mt-2">{{$lang['15']}}</p>
                                <p class="mt-2">\( {{$set_len}} \)</p>
                                <p class="mt-2">{{$lang['16']}}</p>
                                <p class="mt-2">
                                    \(
                                        @php
                                            if(isset($lo_ro)){
                                                echo 'left \space '.$lang["17"].' \space \mid \space right \space '.$lang["17"];
                                            }elseif(isset($lo_rc)){
                                                echo 'left \space '.$lang["17"].' \space \mid \space right \space '.$lang["18"];
                                            }elseif(isset($lc_ro)){
                                                echo 'left \space '.$lang["18"].' \space \mid \space right \space '.$lang["17"];
                                            }elseif(isset($lc_rc)){
                                                echo 'left \space '.$lang["18"].' \space \mid \space right \space '.$lang["18"];
                                            }
                                        @endphp
                                    \)
                                </p>
                                @if($set_len>7)
                                    <p class="mt-2">{{$lang['19']}}</p>
                                    <p class="mt-2">
                                        <hr class="col hr_set">
                                    </p>
                                    <p class="mt-2">
                                        <hr class="col hr_set1">
                                    </p>
                                    <p class="mt-2">
                                        @php
                                            $set_v1=floor(($set_len-1)/3);
                                            $set_v2=floor($set_v1*2);
                                            $set_v3=floor($set_v1*3);
                                            echo "<span class='s_set' style='margin-left:5px'>".$set[0]."</span>
                                                <span class='s_set'>".$set[$set_v1]."</span>
                                                <span class='s_set'>".$set[$set_v2]."</span>
                                                <span class='s_set'>".$set[$set_v3]."</span>
                                                <span class='s_set'>".end($set)."</span>
                                            ";
                                        @endphp
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        
        @push('calculatorJS')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
            <script type="text/x-mathjax-config">
                MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
            </script>
        @endpush
    @endisset
</form>