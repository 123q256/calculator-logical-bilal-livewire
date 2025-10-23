<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2"> 
                    <select name="operations" id="operations" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['2'],$lang['3'],$lang['4'],$lang['5'],$lang['6'],$lang['7'],$lang['8'],$lang['9'],$lang['10'],$lang['11'],$lang['12'],$lang['13'],$lang['14'],$lang['15'],$lang['16'],$lang['17'],$lang['18'],$lang['19'],$lang['20'],$lang['21'],$lang['22'],$lang['23']];
                            $val = ['3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
                            optionsList($val,$name,isset($_POST['operations'])?$_POST['operations']:'3');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" id="1">
                <label for="first" class="font-s-14 text-blue" id="lb_1">
                    {{ $lang['24'] }}
                :</label>
                <div class="w-100 py-2 position-relative"> 
                    <input type="number" step="any" name="first" id="first" class="input" aria-label="input"  value="{{ isset($_POST['first'])?$_POST['first']: '5'}}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 second" id="2">
                <label for="second" class="font-s-14 text-blue" id="lb_2">
                    {{ $lang['25'] }}                          
                :</label>
                <div class="w-100 py-2 position-relative"> 
                    <input type="number" step="any" name="second" id="second" class="input" aria-label="input"  value="{{ isset($_POST['second'])?$_POST['second']:'3' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 third " id="3">
                <label for="third" class="font-s-14 text-blue" id="lb_3">
                    {{ $lang['26'] }} 
                :</label>
                <div class="w-100 py-2 position-relative"> 
                    <input type="number" step="any" name="third" id="third" class="input" aria-label="input"  value="{{ isset($_POST['third'])?$_POST['third']:'4' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 four hidden " id="4">
                <label for="four" class="font-s-14 text-blue" id="lb_4">{{ $lang['27'] }} (a):</label>
                <div class="w-100 py-2 position-relative"> 
                    <input type="number" step="any" name="four" id="four" class="input" aria-label="input"  value="{{ isset($_POST['four'])?$_POST['four']:'6' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 five hidden" id="5">
                <label for="five" class="font-s-14 text-blue" id="lb_5">{{$lang['28']}}:</label>
                <div class="w-100 py-2 position-relative"> 
                    <input type="number" step="any" name="five" id="five" class="input" aria-label="input"  value="{{ isset($_POST['five'])?$_POST['five']:'2' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 fiveb hidden" id="5b">
                <label for="fiveb" class="font-s-14 text-blue" id="lb_5b">{{$lang['29']}}:</label>
                <div class="w-100 py-2 position-relative"> 
                    <input type="number" step="any" name="fiveb" id="fiveb" class="input" aria-label="input"  value="{{ isset($_POST['fiveb'])?$_POST['fiveb']:'4' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 six hidden" id="6">
                <label for="six" class="font-s-14 text-blue" id="lb_6">{{$lang['30']}}:</label>
                <div class="w-100 py-2 position-relative"> 
                    <input type="number" step="any" name="quantity" id="six" class="input" aria-label="input"  value="{{ isset($_POST['six'])?$_POST['six']:'7' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 seven hidden" id="7">
                <label for="seven" class="font-s-14 text-blue" id="lb_7">{{$lang['31']}}:</label>
                <div class="w-100 py-2 position-relative"> 
                    <input type="number" step="any" name="seven" id="seven" class="input" aria-label="input"  value="{{ isset($_POST['seven'])?$_POST['seven']:'9' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 eight hidden" id="8">
                <label for="eight" class="font-s-14 text-blue" id="lb_8">{{$lang['31']}}:</label>
                <div class="w-100 py-2 position-relative"> 
                    <input type="number" step="any" name="eight" id="eight" class="input" aria-label="input"  value="{{ isset($_POST['eight'])?$_POST['eight']:'3' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 nine hidden" id="9">
                <label for="nine" class="font-s-14 text-blue" id="lb_9">{{$lang['31']}}:</label>
                <div class="w-100 py-2 position-relative"> 
                    <input type="number" step="any" name="nine" id="nine" class="input" aria-label="input"  value="{{ isset($_POST['nine'])?$_POST['nine']:'7' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 ten hidden" id="10">
                <label for="ten" class="font-s-14 text-blue" id="lb_10">{{$lang['31']}}:</label>
                <div class="w-100 py-2 position-relative"> 
                    <input type="number" step="any" name="ten" id="ten" class="input" aria-label="input"  value="{{ isset($_POST['ten'])?$_POST['ten']:'3' }}" />
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
                    <div class="w-full my-2">
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{$detail['heading']}}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3"><strong class="text-blue">{{($detail['batting'])}}</strong></p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        var one = document.getElementById('1');
        var two = document.getElementById('2');
        var three = document.getElementById('3');
        var four = document.getElementById('4');
        var five = document.getElementById('5');
        var fiveb = document.getElementById('5b');
        var six = document.getElementById('6');
        var seven = document.getElementById('7');
        var eight = document.getElementById('8');
        var nine = document.getElementById('9');
        var ten = document.getElementById('10');
        @if(isset($detail))
            var cal = document.getElementById('operations').value;
            if(cal=='3'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent =  "Number of Runs Scored:";
                document.getElementById('lb_2').textContent = "Number of Innings Played:";
                document.getElementById('lb_3').textContent = "Number of Times Not Out:";
            }else if(cal=='4'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'none';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Number of At Bats:";
                document.getElementById('lb_2').textContent = "Number of Hits:";
            }else if(cal=='5'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'block';
                five.style.display = 'block';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "At Bats:";
                document.getElementById('lb_2').textContent = "Hits:";
                document.getElementById('lb_3').textContent = "Walks:";
                document.getElementById('lb_4').textContent = "Hit by Pitch:";
                document.getElementById('lb_5').textContent = "Sacrifice Flies:";
            }else if(cal=='6'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'block';
                five.style.display = 'block';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "At Bats:";
                document.getElementById('lb_2').textContent = "Singles:";
                document.getElementById('lb_3').textContent = "Doubles:";
                document.getElementById('lb_4').textContent = "Triples:";
                document.getElementById('lb_5').textContent = "Home Runs:";
            }else if(cal=='7'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'block';
                five.style.display = 'block';
                six.style.display = 'block';
                fiveb.style.display = 'block';
                seven.style.display = 'block';
                eight.style.display = 'block';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Singles:";
                document.getElementById('lb_2').textContent = "Doubles:";
                document.getElementById('lb_3').textContent = "Triples:";
                document.getElementById('lb_4').textContent = "Home Runs:";
                document.getElementById('lb_5').textContent = "Hits:";
                document.getElementById('lb_6').textContent = "Walks:";
                document.getElementById('lb_5b').textContent = "Sacrifice Flies:";
                document.getElementById('lb_7').textContent = "Hits by Pitch:";
                document.getElementById('lb_8').textContent = "At Bats:";
            }else if(cal=='8'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'block';
                five.style.display = 'block';
                six.style.display = 'block';
                fiveb.style.display = 'block';
                seven.style.display = 'block';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Plate Appearances:";
                document.getElementById('lb_2').textContent = "Non Intentional Walks (BB-IBB):";
                document.getElementById('lb_3').textContent = "Hit by Pitch:";
                document.getElementById('lb_4').textContent = "Singles:";
                document.getElementById('lb_5').textContent = "Doubles:";
                document.getElementById('lb_6').textContent = "Triples:";
                document.getElementById('lb_5b').textContent = "Home Runs:";
                document.getElementById('lb_7').textContent = "Reached Base on Error:";
            }else if(cal=='9'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'block';
                five.style.display = 'block';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "At Bats:";
                document.getElementById('lb_2').textContent = "Hits:";
                document.getElementById('lb_3').textContent = "Home Runs:";
                document.getElementById('lb_4').textContent = "Sacrifice Flies:";
                document.getElementById('lb_5').textContent = "Strikeouts:";
            }else if(cal=='10'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'block';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "At Bats:";
                document.getElementById('lb_2').textContent = "Doubles:";
                document.getElementById('lb_3').textContent = "Triples:";
                document.getElementById('lb_4').textContent = "Home Runs:";
            }else if(cal=='11'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'block';
                five.style.display = 'block';
                six.style.display = 'block';
                fiveb.style.display = 'block';
                seven.style.display = 'block';
                eight.style.display = 'block';
                nine.style.display = 'block';
                ten.style.display = 'block';
                document.getElementById('lb_1').textContent = "At Bats:";
                document.getElementById('lb_2').textContent = "Hits:";
                document.getElementById('lb_3').textContent = "Walks:";
                document.getElementById('lb_4').textContent = "Total Bases:";
                document.getElementById('lb_5').textContent = "Hit by Pitch:";
                document.getElementById('lb_6').textContent = "GIDP (Grounded into Double Play):";
                document.getElementById('lb_5b').textContent = "IBB (Intentional Base on Balls):";
                document.getElementById('lb_7').textContent = "Sacrifice Hits:";
                document.getElementById('lb_8').textContent = "Sacrifice Flies:";
                document.getElementById('lb_9').textContent = "Stolen Bases:";
                document.getElementById('lb_10').textContent = "Caught Stealing:";
            }else if(cal=='12'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'block';
                five.style.display = 'block';
                six.style.display = 'block';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Total Bases:";
                document.getElementById('lb_2').textContent = "Hits:";
                document.getElementById('lb_3').textContent = "Walks:";
                document.getElementById('lb_4').textContent = "Stolen Bases:";
                document.getElementById('lb_5').textContent = "Caught Stealing:";
                document.getElementById('lb_6').textContent = "At Bats:";
            }else if(cal=='13'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'block';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Singles:";
                document.getElementById('lb_2').textContent = "Doubles:";
                document.getElementById('lb_3').textContent = "Triples:";
                document.getElementById('lb_4').textContent = "Home Runs:";
            }else if(cal=='14'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'none';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "At Bats:";
                document.getElementById('lb_2').textContent = "Home Runs:";
            }else if(cal=='15'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Assists:";
                document.getElementById('lb_2').textContent = "Putouts:";
                document.getElementById('lb_3').textContent = "Errors:";
            }else if(cal=='16'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Games Played:";
                document.getElementById('lb_2').textContent = "Putouts:";
                document.getElementById('lb_3').textContent = "Assists:";
            }else if(cal=='17'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Innings Played:";
                document.getElementById('lb_2').textContent = "Putouts:";
                document.getElementById('lb_3').textContent = "Assists:";
            }else if(cal=='18'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'none';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Earned Runs:";
                document.getElementById('lb_2').textContent = "Innings Pitched:";
            }else if(cal=='19'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Hits Allowed:";
                document.getElementById('lb_2').textContent = "Walks Allowed:";
                document.getElementById('lb_3').textContent = "Innings Pitched:";
            }else if(cal=='20'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'none';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Innings Pitched:";
                document.getElementById('lb_2').textContent = "Hits Allowed:";
            }else if(cal=='21'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'none';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Innings Pitched:";
                document.getElementById('lb_2').textContent = "Home Runs:";
            }else if(cal=='22'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'none';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Innings Pitched:";
                document.getElementById('lb_2').textContent = "Strikeouts:";
            }else if(cal=='23'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'none';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Innings Pitched:";
                document.getElementById('lb_2').textContent = "Walks:";
            }else if(cal=='24'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'none';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Strikeouts:";
                document.getElementById('lb_2').textContent = "Walks:";
            }
        @endif
        document.getElementById('operations').addEventListener('change', function() {
            var cal=this.value;
            if(cal=='3'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent =  "Number of Runs Scored:";
                document.getElementById('lb_2').textContent = "Number of Innings Played:";
                document.getElementById('lb_3').textContent = "Number of Times Not Out:";
            }else if(cal=='4'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'none';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Number of At Bats:";
                document.getElementById('lb_2').textContent = "Number of Hits:";
            }else if(cal=='5'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'block';
                five.style.display = 'block';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "At Bats:";
                document.getElementById('lb_2').textContent = "Hits:";
                document.getElementById('lb_3').textContent = "Walks:";
                document.getElementById('lb_4').textContent = "Hit by Pitch:";
                document.getElementById('lb_5').textContent = "Sacrifice Flies:";
            }else if(cal=='6'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'block';
                five.style.display = 'block';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "At Bats:";
                document.getElementById('lb_2').textContent = "Singles:";
                document.getElementById('lb_3').textContent = "Doubles:";
                document.getElementById('lb_4').textContent = "Triples:";
                document.getElementById('lb_5').textContent = "Home Runs:";
            }else if(cal=='7'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'block';
                five.style.display = 'block';
                six.style.display = 'block';
                fiveb.style.display = 'block';
                seven.style.display = 'block';
                eight.style.display = 'block';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Singles:";
                document.getElementById('lb_2').textContent = "Doubles:";
                document.getElementById('lb_3').textContent = "Triples:";
                document.getElementById('lb_4').textContent = "Home Runs:";
                document.getElementById('lb_5').textContent = "Hits:";
                document.getElementById('lb_6').textContent = "Walks:";
                document.getElementById('lb_5b').textContent = "Sacrifice Flies:";
                document.getElementById('lb_7').textContent = "Hits by Pitch:";
                document.getElementById('lb_8').textContent = "At Bats:";
            }else if(cal=='8'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'block';
                five.style.display = 'block';
                six.style.display = 'block';
                fiveb.style.display = 'block';
                seven.style.display = 'block';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Plate Appearances:";
                document.getElementById('lb_2').textContent = "Non Intentional Walks (BB-IBB):";
                document.getElementById('lb_3').textContent = "Hit by Pitch:";
                document.getElementById('lb_4').textContent = "Singles:";
                document.getElementById('lb_5').textContent = "Doubles:";
                document.getElementById('lb_6').textContent = "Triples:";
                document.getElementById('lb_5b').textContent = "Home Runs:";
                document.getElementById('lb_7').textContent = "Reached Base on Error:";
            }else if(cal=='9'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'block';
                five.style.display = 'block';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "At Bats:";
                document.getElementById('lb_2').textContent = "Hits:";
                document.getElementById('lb_3').textContent = "Home Runs:";
                document.getElementById('lb_4').textContent = "Sacrifice Flies:";
                document.getElementById('lb_5').textContent = "Strikeouts:";
            }else if(cal=='10'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'block';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "At Bats:";
                document.getElementById('lb_2').textContent = "Doubles:";
                document.getElementById('lb_3').textContent = "Triples:";
                document.getElementById('lb_4').textContent = "Home Runs:";
            }else if(cal=='11'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'block';
                five.style.display = 'block';
                six.style.display = 'block';
                fiveb.style.display = 'block';
                seven.style.display = 'block';
                eight.style.display = 'block';
                nine.style.display = 'block';
                ten.style.display = 'block';
                document.getElementById('lb_1').textContent = "At Bats:";
                document.getElementById('lb_2').textContent = "Hits:";
                document.getElementById('lb_3').textContent = "Walks:";
                document.getElementById('lb_4').textContent = "Total Bases:";
                document.getElementById('lb_5').textContent = "Hit by Pitch:";
                document.getElementById('lb_6').textContent = "GIDP (Grounded into Double Play):";
                document.getElementById('lb_5b').textContent = "IBB (Intentional Base on Balls):";
                document.getElementById('lb_7').textContent = "Sacrifice Hits:";
                document.getElementById('lb_8').textContent = "Sacrifice Flies:";
                document.getElementById('lb_9').textContent = "Stolen Bases:";
                document.getElementById('lb_10').textContent = "Caught Stealing:";
            }else if(cal=='12'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'block';
                five.style.display = 'block';
                six.style.display = 'block';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Total Bases:";
                document.getElementById('lb_2').textContent = "Hits:";
                document.getElementById('lb_3').textContent = "Walks:";
                document.getElementById('lb_4').textContent = "Stolen Bases:";
                document.getElementById('lb_5').textContent = "Caught Stealing:";
                document.getElementById('lb_6').textContent = "At Bats:";
            }else if(cal=='13'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'block';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Singles:";
                document.getElementById('lb_2').textContent = "Doubles:";
                document.getElementById('lb_3').textContent = "Triples:";
                document.getElementById('lb_4').textContent = "Home Runs:";
            }else if(cal=='14'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'none';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "At Bats:";
                document.getElementById('lb_2').textContent = "Home Runs:";
            }else if(cal=='15'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Assists:";
                document.getElementById('lb_2').textContent = "Putouts:";
                document.getElementById('lb_3').textContent = "Errors:";
            }else if(cal=='16'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Games Played:";
                document.getElementById('lb_2').textContent = "Putouts:";
                document.getElementById('lb_3').textContent = "Assists:";
            }else if(cal=='17'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Innings Played:";
                document.getElementById('lb_2').textContent = "Putouts:";
                document.getElementById('lb_3').textContent = "Assists:";
            }else if(cal=='18'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'none';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Earned Runs:";
                document.getElementById('lb_2').textContent = "Innings Pitched:";
            }else if(cal=='19'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'block';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Hits Allowed:";
                document.getElementById('lb_2').textContent = "Walks Allowed:";
                document.getElementById('lb_3').textContent = "Innings Pitched:";
            }else if(cal=='20'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'none';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Innings Pitched:";
                document.getElementById('lb_2').textContent = "Hits Allowed:";
            }else if(cal=='21'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'none';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Innings Pitched:";
                document.getElementById('lb_2').textContent = "Home Runs:";
            }else if(cal=='22'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'none';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Innings Pitched:";
                document.getElementById('lb_2').textContent = "Strikeouts:";
            }else if(cal=='23'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'none';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Innings Pitched:";
                document.getElementById('lb_2').textContent = "Walks:";
            }else if(cal=='24'){
                one.style.display = 'block';
                two.style.display = 'block';
                three.style.display = 'none';
                four.style.display = 'none';
                five.style.display = 'none';
                six.style.display = 'none';
                fiveb.style.display = 'none';
                seven.style.display = 'none';
                eight.style.display = 'none';
                nine.style.display = 'none';
                ten.style.display = 'none';
                document.getElementById('lb_1').textContent = "Strikeouts:";
                document.getElementById('lb_2').textContent = "Walks:";
            }
        });
    </script>
@endpush