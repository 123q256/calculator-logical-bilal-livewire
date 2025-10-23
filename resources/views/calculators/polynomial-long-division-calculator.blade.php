<style>
    .icon_animation {
        display: inline-block;
        position: relative;
        width: 100%;
        height: 80px;
    }
    .icon_animation samp {
        display: inline-block;
        position: absolute;
        left: 0; /* Adjusted to start from the left edge */
        background: #EEF1F5;
        animation: icon_animation 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
        height: 8px;
    }
    .main_area .icon_sty:hover .icon_animation samp {
        background: #fff;
    }

    .icon_animation samp:nth-child(1) {
        top: 10px;
        animation-delay: -0.24s;
    }
    .icon_animation samp:nth-child(2) {
        top: 28px;
        left: 0; /* Starts from the left edge */
        animation-delay: -0.12s;
    }
    .icon_animation samp:nth-child(3) {
        top: 47px;
        animation-delay: 0s;
    }

    .icon_animation samp:nth-child(4) {
        top: 66px; /* Adjusted for 4th element */
        animation-delay: 0.12s; /* Slightly delayed */
    }
    .icon_animation samp:nth-child(5) {
        top: 85px; /* Adjusted for 5th element */
        animation-delay: 0.24s; /* Further delayed */
    }

    @keyframes icon_animation {
        0% {
            left: 0;
            width: 0;
        }
        50%, 100% {
            left: 0; /* Stays at the left edge */
            width: 100%; /* Expands to full width */
        }
    }

    #responseContainer{
        line-height: 2
    }

    #responseContainer ol,#responseContainer ul{
        padding-left: 20px
    }

    .mere_li p, .mere_li li:not(:has(p)){
        font-size: 17px;
        letter-spacing: .5px;
        line-height: 1.5;
        color: #000000;
    }

    .mere_li p:not(:first-child),.mere_li ol p,.mere_li ul p, .mere_li li:not(:has(p)) {
        margin-top: 12px;
    }

    #responseContainer h3,#responseContainer h2{
        font-size: 22px;
        font-weight: 600 !important;
        margin-top: 12px;
        letter-spacing: .5px;
        line-height: 1.5;
        color: #000000;
    }

    @keyframes blink {
    0%, 100% {
      border-color: transparent;
    }
    50% {
      border-color: #2845F5;
    }
  }

  #exampleLoadBtn {
    animation: blink 1s infinite;
    border: 2px solid transparent; /* Default border transparent */
    background: #1670a712;
    padding: 10x 15px;
    border-radius: 5px;
    cursor: pointer;
    color: #000000;
  }
</style>

<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @isset($detail)
                <style>
                    #exampleLoadBtn{
                        background: #1670a712
                    }
                </style>
            @endisset

            <div class="col-span-12">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 md:col-span-8 lg:col-span-8 flex items-center">
                    <label for="equ" class="label" id="heading2">{{ $lang[1] }} y = f(x) =</label>
                    </div>
                    <div class="col-span-12 md:col-span-4 lg:col-span-4 flex justify-end items-center">
                    <button type="button" class="flex items-center p-1" id="exampleLoadBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right size-4 me-1" style="transform: rotate(180deg);"><path d="M7 7h10v10"></path><path d="M7 17 17 7"></path></svg>
                        Load Example
                    </button>
                    </div>
                </div>
                <div class="w-100 py-2">
                    <input type="text" name="dividend" id="dividend" class="input" value="{{ isset($_POST['dividend']) ? $_POST['dividend'] : '2x^3 - 3x^2 + 13x - 5' }}" aria-label="input" />
                </div>
            </div>
          
            <div class="col-span-12">
                <label for="divisor" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                <div class="w-100 py-2">
                    <input type="text" min="0" name="divisor" id="divisor" class="input" value="{{ isset($_POST['divisor']) ? $_POST['divisor'] : 'x + 5' }}" aria-label="input" />
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
                            $check=$detail['check'];
                            $dividend=$detail['eq'];
                            $divisor=$detail['eq1'];
                            $quot=$detail['quot'];
                            $rmnd=$detail['rmnd'];
                            $quotient=$detail['quotient'];
                            $multiplies=$detail['multiplies'];
                            $steps=$detail['steps'];
                            $divCoeff=$detail['divCoeff'];
                            $loop_len=$detail['loop_len'];
                            $leading_term=$detail['leading_term'];
                            $divby_lt=$detail['divby_lt'];
                        @endphp
                        <div class="w-full text-[16px] {{ $device=='mobile' ? 'overflow-auto' : '' }}">
                            <p class="mt-3 text-[18px]">\( <?=($rmnd==='0')?preg_replace('/frac/','dfrac',$quot):preg_replace('/frac/','dfrac',$quot)."+\dfrac{($rmnd)}{{$divisor}}"?> \)</p>
                            @if($check!=="xy")
                                @php
                                    $dividend1='';
                                    $count=count($divCoeff)-1;
                                    foreach($divCoeff as $key => $value){
                                    if(!preg_match('/-/',$value) && $key!==0){
                                        $value='+'.$value;
                                    }
                                    if($count-$key===0){
                                        $dividend1.=$value;
                                    }elseif($count-$key===1){
                                        $dividend1.=$value.'x';
                                    }elseif($value==='1' || $value==='+1' || $value==='-1'){
                                        $dividend1.="x^".($count-$key);
                                    }else{
                                        $dividend1.=$value."x^".($count-$key);
                                    }
                                    $dividend1=preg_replace('/\+/',' + ',$dividend1);
                                    $dividend1=preg_replace('/-/',' - ',$dividend1);
                                    }
                                    $and="&";
                                @endphp
                                <p class="mt-3"><strong>{{$lang['5']}}:</strong></p>
                                <p class="mt-3">{{$lang['6']}}</p>
                                <p class="mt-3">
                                    \( 
                                        \require{enclose}\begin{array}{rrrrrr} \\ {{$divisor}}&\phantom{-}\enclose{longdiv}{\begin{array}{cccccc}{{preg_replace('/(\s\+\s)/',' & + ',(preg_replace('/(\s-\s)/',' & - ',$dividend1)))}}\end{array}}\end{array}
                                    \)
                                </p>
                                @for($i=0; $i < $loop_len; $i++)
                                    <p class="mt-3">{{$lang[7]}} {{$i+1}}</p>
                                    <p class="mt-2">{{$lang[8]}}:\( \space \dfrac{ {{$leading_term[$i]}} }{ {{$divby_lt}} } = {{$quotient[$i]}} \)</p>
                                    <p class="mt-3">{{$lang[9]}}.</p>
                                    <p class="mt-3">{{$lang[10]}}: \( \space {{$quotient[$i]}}({{$divisor}}) = {{$multiplies[$i]}} \).</p>
                                    <p class="mt-3">{{$lang[11]}}:</p>
                                    <p class="mt-3">\( ({{$dividend}}) - ({{$multiplies[$i]}}) = {{$steps[$i]}} \).</p>
                                @endfor
                                <p class="mt-3">{{$lang[12]}}:</p>
                                <p class="mt-3">
                                    \( 
                                        \require{enclose}\begin{array}{rlc} \phantom{ {{$divisor}} }&\phantom{\enclose{longdiv}{}-}\begin{array}{rrrrrr} {{(preg_replace('/frac/','dfrac',(preg_replace('/(\s\+\s)/',' & + ',(preg_replace('/(\s-\s)/',' & - ',$quot))))))}}&\end{array}&\\{{$divisor}}&\phantom{-}\enclose{longdiv}{\begin{array}{cccccc}{{preg_replace('/(\s\+\s)/',' & + ',(preg_replace('/(\s-\s)/',' & - ',$dividend1)))}}\end{array}}\\&\begin{array}{rrrrrr}-\\\phantom{\enclose{longdiv}{}}
                                        {{preg_replace('/(\s\+\s)/',' & + ',(preg_replace('/(\s-\s)/',' & - ',$multiplies[0])))}}\\\hline\phantom{\enclose{longdiv}{}}&{{(preg_replace('/(\s\+\s)/',' & + ',(preg_replace('/(\s-\s)/',' & - ',$steps[0]))))}}
                                        <?php for($i=1; $i < $loop_len; $i++){
                                        $and.="&";
                                        ?>
                                        \\{{substr($and,'1')}}-\\\phantom{\enclose{longdiv}{}}{{substr($and,'1')}}{{preg_replace('/(\s\+\s)/',' & + ',(preg_replace('/(\s-\s)/',' & - ',$multiplies[$i])))}}\\\hline\phantom{\enclose{longdiv}{}}{{$and}}{{(preg_replace('/(\s\+\s)/',' & + ',(preg_replace('/(\s-\s)/',' & - ',$steps[$i]))))}}
                                        <?php } ?>
                                        \\\\\phantom{\enclose{longdiv}{}}{{$and}}{{preg_replace('/(\s\+\s)/',' & + ',(preg_replace('/(\s-\s)/',' & - ',$multiplies[$loop_len-1])))}}\end{array}&\begin{array}{c}\\\phantom{ {{(preg_replace('/(\s\+\s)/',' & + ',(preg_replace('/(\s-\s)/',' & - ',$steps[$loop_len-1]))))}} }
                                    \end{array}\end{array} 
                                    \)
                                </p>
                                <p class="mt-3">
                                    \( \text{ {{$lang[13]}} } \space { {{preg_replace('/frac/','dfrac',$quot)}} }, \space \text{ {{$lang[14]}} } \space { {{preg_replace('/frac/','dfrac',$rmnd)}} } \)
                                </p>
                                <p class="mt-3">{{$lang[15]}}:</p>
                                <p class="col s12 font_size18 margin_top_15">\( \dfrac{<?=$dividend?>}{<?=$divisor?>} = {<?=($rmnd==='0')?preg_replace('/frac/','dfrac',$quot):preg_replace('/frac/','dfrac',$quot)."+\dfrac{($rmnd)}{{$divisor}}"?>} \)</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        @if (isset($detail))
            <script>
                function loadMathJax() {
                    var mathJaxScript = document.createElement('script');
                    mathJaxScript.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
                    document.querySelector('head').appendChild(mathJaxScript);
                
                    var mathJaxConfigScript = document.createElement('script');
                    mathJaxConfigScript.type = "text/x-mathjax-config";
                    mathJaxConfigScript.textContent = 'MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}}); function MJrerender() { MathJax.Hub.Queue(["Rerender", MathJax.Hub]); }';
                    document.querySelector('head').appendChild(mathJaxConfigScript);
                }
                
                window.addEventListener('load', function () {
                    loadMathJax();
                });
            </script>
        @endif
        <script>
            document.querySelector('#exampleLoadBtn').addEventListener('click', function() {
                var eq = [
                    "3x^3 + x^2 - 4x + 1",
                    "x^3 + x^2 + x + 1",
                    "3x^3 - 5x^2 + 10x - 3",
                    "4x^3 - 3x^2+ 4x",
                ];
                var t = eq[Math.floor(Math.random() * eq.length)];
                document.querySelector("#dividend").value = t;
            });
        </script>
    @endpush
</form>