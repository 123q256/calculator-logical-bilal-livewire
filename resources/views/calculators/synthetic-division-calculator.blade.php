<style>
    .synth_steps{
        font-size: 17px;
        letter-spacing: .5px;
        line-height: 32px;
    }
</style>
<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12">
                <label for="dividend" class="font-s-14 text-blue">{{$lang[1]}}</label>
                <div class="w-full py-2">
                    <input type="text" name="dividend" id="dividend" class="input" value="{{ isset($_POST['dividend'])?$_POST['dividend']:'7x^3 + 4x + 8' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="divisor" class="font-s-14 text-blue">{{$lang[2]}} (ax + b)</label>
                <div class="w-full py-2">
                    <input type="text" name="divisor" id="divisor" class="input" value="{{ isset($_POST['divisor'])?$_POST['divisor']:'x + 2' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="equation_preview" class="font-s-14 text-blue">Equation Preview</label>
                <p class="col-12 mt-0 mt-lg-2 pt-2 radius_10 bg-sky text-center mx-auto overflow-auto radius-5 border" id="equation_preview"></p>
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
                            $dividend=$detail['eq'];
                            $divisor=$detail['eq1'];
                            $coeffs=$detail['coeffs'];
                            $divby=$detail['divby'];
                            $quot=$detail['quot'];
                            $rmnd=$detail['rmnd'];
                            $divby1=$detail['divby1'];
                            $coeffs1=$detail['coeffs1'];
                        @endphp
                        <div class="col-12 text-[16px] {{ $device=='mobile' ? 'overflow-auto' : '' }}">
                            <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2 mt-2 text-[16px] overflow-auto">
                                <p class="mt-2">
                                    <strong>Quotient = </strong>\( {{ $quot }} \)
                                </p>
                                <p class="mt-3">
                                    <strong>Remainder = </strong>\( {{ $rmnd }} \)
                                </p>
                            </div>
                            <p class="mt-2"><strong>Step by Step Solution:</strong></p>
                            <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2 mt-2 overflow-auto synth_steps">
                                <p class="mt-3">\( \dfrac{<?=$dividend?>}{<?=$divisor?>} \)</p>
                                <p class="mt-3">{{$lang[6]}}</p>
                                <p class="mt-3">
                                    \(
                                        @php
                                            for($i=0; $i < count($coeffs1)-1; $i++){
                                                if(count($coeffs1)-2===$i){
                                                    echo $coeffs1[$i];
                                                }else{
                                                    echo $coeffs1[$i].', ';
                                                }
                                            }
                                        @endphp
                                    \)
                                </p>
                                <p class="mt-3">{{$lang[7]}}</p>
                                <p class="mt-3">\( {{$divisor}} = 0 \)</p>
                                @if(preg_match('/frac/',$divby1))
                                    <p class="mt-3">\( x = {{str_replace('frac','dfrac',$divby1)}} \)</p>
                                @endif
                                <p class="mt-3">\( x = {{$divby}} \)</p>
                                <p class="mt-3">{{$lang[8]}}</p>
                                <p class="mt-4">
                                    \(
                                        \begin{array}{c|rrrrr}&
                                        @php
                                            for($i=count($coeffs)-1; $i > 0; $i--){
                                                if($i+(count($coeffs)-2)===(count($coeffs)-1)){
                                                    echo 'x^{'.($i-1).'}';
                                                }else{
                                                    echo 'x^{'.($i-1).'}&';
                                                }
                                            }
                                        @endphp
                                        \\{{$divby}}&
                                        @php
                                            for($i=0; $i < count($coeffs)-1; $i++){
                                                if(count($coeffs)-2===$i){
                                                    echo $coeffs[$i];
                                                }else{
                                                    echo $coeffs[$i].'&';
                                                }
                                            }      
                                        @endphp
                                        \\&&\\\hline&\end{array}
                                    \)
                                </p>
                                <p class="mt-3">{{$lang[9]}}</p>
                                <p class="mt-4">
                                    \( 
                                        \begin{array}{c|rrrrr}{{$divby}}&
                                        @php
                                            for($i=0; $i < count($coeffs)-1; $i++){
                                                if($i===0){
                                                    echo $coeffs[$i].'&';
                                                }elseif(count($coeffs)-2===$i){
                                                    echo $coeffs[$i];
                                                }else{
                                                    echo $coeffs[$i].'&';
                                                }
                                            }      
                                        @endphp
                                        \\&&\\\hline&{{$coeffs[0]}}\end{array}
                                    \)
                                </p>
                                @php
                                    $outer_len=(count($coeffs)-2)*2;
                                    $k=0;
                                    $carry=array();
                                    $carries=array();
                                    $muls=array();
                                    $carry[0]=$coeffs[0];
                                @endphp
                                @for($i=0; $i < $outer_len; $i++)
                                    @php
                                        if($i>1){
                                            if($i%2===0){
                                                $k++;
                                            }
                                        }
                                    @endphp
                                    @if(($i%2)===0)
                                        <p class="mt-3">{{$lang[10]}}</p>
                                        <p class="mt-3">\( {{$carry[$k]}} * ({{$divby}}) = {{$carries[$k]=$carry[$k]*$divby}} \)</p>
                                        <p class="mt-4">
                                            \(
                                                @php
                                                    echo "\begin{array}{c|rrrrr}$divby&";
                                                    for($j=0; $j < count($coeffs)-1; $j++){
                                                        if(count($coeffs)-2===$j){
                                                            echo $coeffs[$j];
                                                        }else{
                                                            echo $coeffs[$j].'&';
                                                        }
                                                    }
                                                    echo "\\\&&";
                                                    for($x=0; $x < count($carries); $x++){
                                                        echo $carries[$x].'&';
                                                    }
                                                    echo "\\\\\hline&".$coeffs[0]."&";
                                                    for($x=0; $x < count($muls); $x++){
                                                        echo $muls[$x].'&';
                                                    }
                                                    echo "\\end{array}";
                                                @endphp
                                            \)
                                        </p>
                                    @else
                                        <p class="mt-3">{{$lang[11]}}</p>
                                        <p class="mt-3">\( {{$coeffs[$k+1]}} + ({{$carries[$k]}}) = {{$muls[$k]=($coeffs[$k+1]+$carries[$k])}} \)</p>
                                        <p class="mt-4">
                                            \(
                                                @php
                                                    echo "\begin{array}{c|rrrrr}$divby&";
                                                    for($j=0; $j < count($coeffs)-1; $j++){
                                                        if(count($coeffs)-2===$j){
                                                            echo $coeffs[$j];
                                                        }else{
                                                            echo $coeffs[$j].'&';
                                                        }
                                                    }
                                                    echo "\\\&&";
                                                    for($y=0; $y < count($carries); $y++){
                                                        echo $carries[$y].'&';
                                                    }
                                                    echo "\\\\\hline&".$coeffs[0]."&";
                                                    for($y=0; $y < count($muls); $y++){
                                                        echo $muls[$y].'&';
                                                    }
                                                    echo "\\end{array}";
                                                    $carry[$k+1]=$muls[$k];            
                                                @endphp
                                            \)
                                        </p>
                                    @endif
                                @endfor
                                <p class="mt-4">\( \text{ {{$lang[12]}} } \space { {{$quot}} }, \space \text{ {{$lang[13]}} } \space { {{$rmnd}} } \)</p>
                                <p class="mt-3">{{$lang[14]}}:</p>
                                <p class="mt-4">\( \dfrac{ {{$dividend}} }{ {{$divisor}} } = { {{$quot}} {{(preg_match('/\-/',$rmnd))?'-':'+'}} \dfrac{ {{preg_replace('/\-|\+/','',$rmnd)}} }{ {{$divisor}} } {{($rmnd==='0')?"= $quot":""}} } \)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        {{-- <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" 
        onload="renderMathInElement(document.body);"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/katex@0.16.0/dist/katex.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/katex@0.16.0/dist/contrib/auto-render.min.js"></script>
        <script>
            function updateEquationPreview() {
                var dividend = document.getElementById('dividend').value;
                var divisor = document.getElementById('divisor').value;
                var equation = '\\frac{' + dividend + '}{' + divisor + '}';
                katex.render(equation, document.getElementById('equation_preview'), {
                    throwOnError: false,
                    displayMode: true
                });
            }
            document.getElementById('dividend').addEventListener('input', updateEquationPreview);
            document.getElementById('divisor').addEventListener('input', updateEquationPreview);
            updateEquationPreview();
        </script>
    @endpush
</form>