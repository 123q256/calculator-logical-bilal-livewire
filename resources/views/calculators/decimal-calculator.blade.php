<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                @php
                    if(!isset($detail)){
                        $_POST['rounding'] = "-1";
                    }
                @endphp
                <p class="col-span-12 text-center my-3 text-[18px]">
                    <strong id="changeText">
                        @if (isset($_POST['method']) && $_POST['method'] === '2')
                            a - b = ?
                        @elseif (isset($_POST['method']) && $_POST['method'] === '3')
                            a x b = ?
                        @elseif (isset($_POST['method']) && $_POST['method'] === '4')
                            a ÷ b = ?
                        @elseif (isset($_POST['method']) && $_POST['method'] === '5')
                            a<sup class="font-s-14">b</sup> = ?
                        @elseif (isset($_POST['method']) && $_POST['method'] === '6')
                            <sup class="font-s-14">a</sup>√b = ?
                        @elseif (isset($_POST['method']) && $_POST['method'] === '7')
                            log<sub>a</sub>b = ?
                        @else
                            a + b = ?
                        @endif
                    </strong>
                </p>
                <div class="col-span-12">
                    <label for="method" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2">
                        <select class="input" aria-label="select" name="method" id="method">
                            <option value="1">{{$lang[2]}} (+)</option>
                            <option value="2" {{ isset($_POST['method']) && $_POST['method']=='2'?'selected':'' }}>{{$lang[3]}} (-)</option>
                            <option value="3" {{ isset($_POST['method']) && $_POST['method']=='3'?'selected':'' }}>{{$lang[4]}} (×)</option>
                            <option value="4" {{ isset($_POST['method']) && $_POST['method']=='4'?'selected':'' }}>{{$lang[5]}} (÷)</option>
                            <option value="5" {{ isset($_POST['method']) && $_POST['method']=='5'?'selected':'' }}>{{$lang[6]}}</option>
                            <option value="6" {{ isset($_POST['method']) && $_POST['method']=='6'?'selected':'' }}>{{$lang[7]}} (√)</option>
                            <option value="7" {{ isset($_POST['method']) && $_POST['method']=='7'?'selected':'' }}>{{$lang[8]}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="a" class="font-s-14 text-blue">a</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="a" id="a" class="input" value="{{ isset($_POST['a']) ? $_POST['a'] : '8' }}" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="b" class="font-s-14 text-blue">b</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="b" id="b" class="input" value="{{ isset($_POST['b']) ? $_POST['b'] : '7.65' }}" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="rounding" class="font-s-14 text-blue">Rounding to:</label>
                    <div class="w-100 py-2">
                        <select class="input" aria-label="select" name="rounding" id="rounding">
                            <option value="not" {{ isset($_POST['rounding']) && $_POST['rounding']=='not'?'selected':'' }}>Do Not Round</option>
                            <option value="-3" {{ isset($_POST['rounding']) && $_POST['rounding']=='-3'?'selected':'' }}>Thousands</option>
                            <option value="-2" {{ isset($_POST['rounding']) && $_POST['rounding']=='-2'?'selected':'' }}>Hundreds</option>
                            <option value="-1" {{ isset($_POST['rounding']) && $_POST['rounding']=='-1'?'selected':'' }}>Tens</option>
                            <option value="0" {{ isset($_POST['rounding']) && $_POST['rounding']=='0'?'selected':'' }}>Ones</option>
                            <option value="1" {{ isset($_POST['rounding']) && $_POST['rounding']=='1'?'selected':'' }}>1 decimal</option>
                            <option value="2" {{ isset($_POST['rounding']) && $_POST['rounding']=='2'?'selected':'' }}>2 decimals</option>
                            <option value="3" {{ isset($_POST['rounding']) && $_POST['rounding']=='3'?'selected':'' }}>3 decimals</option>
                            <option value="4" {{ isset($_POST['rounding']) && $_POST['rounding']=='4'?'selected':'' }}>4 decimals</option>
                            <option value="5" {{ isset($_POST['rounding']) && $_POST['rounding']=='5'?'selected':'' }}>5 decimals</option>
                            <option value="6" {{ isset($_POST['rounding']) && $_POST['rounding']=='6'?'selected':'' }}>6 decimals</option>
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
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang[9]}}</strong></td>
                                    <td class="py-2 border-b">{{round($detail['ans'],8)}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>{{ $lang[12] }}</strong></p>
                            @if($_POST['method'] > 4)
                                <p class="mt-2"><strong>{{$lang[11]}}</strong></p>
                                <p class="mt-2">{!!$detail['res']!!}</p>
                            @endif
                            @if($_POST['method'] === "7")
                                @php $floatChkB = explode('.',$_POST['b']); @endphp
                                @if (count($floatChkB)==2)
                                    @php
                                        $divideB = pow(10,strlen($floatChkB[1]));
                                        $newB = $_POST['b']*$divideB;
                                    @endphp
                                    <p class="mt-2">= log<sub class="font-s-14">{{$_POST['a']}}</sub>{{$_POST['b']}}</p>
                                    <p class="mt-2">= log<sub class="font-s-14">{{$_POST['a']}}</sub>({{$newB}}/{{$divideB}})</p>
                                    <p class="mt-2">= log<sub class="font-s-14">{{$_POST['a']}}</sub>({{$newB}}) - log<sub class="font-s-14">{{$_POST['a']}}</sub>({{$divideB}})</p>
                                    <p class="mt-2">= {{$detail['ans']}}</p>
                                @else
                                    <p class="mt-2">= log<sub class="font-s-14">{{$_POST['a']}}</sub>{{$_POST['b']}} = {{$detail['ans']}}</p>
                                @endif
                            @elseif($_POST['method'] === "6")
                                @php
                                    $floatChkA = explode('.',$_POST['a']);
                                    $floatChkB = explode('.',$_POST['b']);
                                @endphp
                                @if(count($floatChkA)==2 && count($floatChkB)==2)
                                    @php
                                        $divideA = pow(10,strlen($floatChkA[1]));
                                        $newA = $_POST['a']*$divideA;
                                        $divideB = pow(10,strlen($floatChkB[1]));
                                        $newB = $_POST['b']*$divideB;
                                    @endphp
                                    <p class="mt-2">= <sup class="font-s-14">{{$_POST['b']}}</sup>√{{$_POST['a']}}</p>
                                    <p class="mt-2">= <sup class="font-s-14">({{$newB}}/{{$divideB}})</sup>√({{$newA}}/{{$divideA}})</p>
                                    <p class="mt-2">= ({{$newB}}/{{$divideB}})<sup class="font-s-14">({{$divideA}}/{{$newA}})</sup></p>
                                    <p class="mt-2">= <sup class="font-s-14">({{$newB}})</sup>√({{$newA}}<sup class="font-s-14">{{$divideB}}</sup>) / <sup class="font-s-14">({{$newB}})</sup>√({{$divideA}}<sup class="font-s-14">{{$divideB}}</sup>)</p>
                                    <p class="mt-2"> = {{$detail['ans']}}</p>
                                @elseif(count($floatChkA)==2)
                                    @php
                                        $divideA = pow(10,strlen($floatChkA[1]));
                                        $newA = $_POST['a']*$divideA;
                                    @endphp
                                    <p class="mt-2">= <sup class="font-s-14">{{$_POST['b']}}</sup>√{{$_POST['a']}}</p>
                                    <p class="mt-2">= <sup class="font-s-14">{{$_POST['b']}}</sup>√({{$newA}}/{{$divideA}})</p>
                                    <p class="mt-2">= <sup class="font-s-14">{{$_POST['b']}}</sup>√({{$newA}}) / <sup class="font-s-14">{{$_POST['b']}}</sup>√({{$divideA}})</p>
                                    <p class="mt-2"> = {{$detail['ans']}}</p>
                                @elseif(count($floatChkB)==2)
                                    @php
                                        $divideB = pow(10,strlen($floatChkB[1]));
                                        $newB = $_POST['b']*$divideB;
                                    @endphp
                                    <p class="mt-2">= <sup class="font-s-14">{{$_POST['b']}}</sup>√{{$_POST['a']}}</p>
                                    <p class="mt-2">= <sup class="font-s-14">{{$newB}}/{{$divideB}}</sup>√{{$_POST['a']}}</p>
                                    <p class="mt-2">={{$_POST['a']}}<sup class="font-s-14">({{$divideB}}/{{$newB}})</sup></p>
                                    <p class="mt-2">= <sup class="font-s-14">{{$newB}}</sup>√({{$_POST['a']}}<sup class="font-s-14">{{$divideB}}</sup>)</p>
                                    <p class="mt-2"> = {{$detail['ans']}}</p>
                                @else
                                    <p class="mt-2">= <sup class="font-s-14">{{$_POST['b']}}</sup>√{{$_POST['a']}} = {{$detail['ans']}}</p>
                                @endif                  
                            @elseif($_POST['method'] === "5")
                                @php
                                    $floatChkA = explode('.',$_POST['a']);
                                    $floatChkB = explode('.',$_POST['b']);
                                @endphp
                                @if(count($floatChkA)==2 && count($floatChkB)==2) 
                                    @php
                                        $divideA = pow(10,strlen($floatChkA[1]));
                                        $newA = $_POST['a']*$divideA;
                                        $divideB = pow(10,strlen($floatChkB[1]));
                                        $newB = $_POST['b']*$divideB;
                                    @endphp
                                    <p class="mt-2">= {{$_POST['a']}}<sup class="font-s-14">{{$_POST['b']}}</sup></p>
                                    <p class="mt-2">= ({{$newA}}/{{$divideA}})<sup class="font-s-14">({{$newB}}/{{$divideB}})</sup></p>
                                    <p class="mt-2">= <sup class="font-s-14">{{$divideB}}</sup>√(({{$newA}})<sup class="font-s-14">{{$newB}}</sup>) / <sup class="font-s-14">{{$divideB}}</sup>√(({{$divideA}})<sup class="font-s-14">{{$newB}}</sup>)</p>
                                    <p class="mt-2"> = {{$detail['ans']}}</p>
                                @elseif(count($floatChkA)==2)
                                    @php
                                        $divideA = pow(10,strlen($floatChkA[1]));
                                        $newA = $_POST['a']*$divideA;
                                    @endphp 
                                    <p class="mt-2">= {{$_POST['a']}}<sup class="font-s-14">{{$_POST['b']}}</sup></p>
                                    <p class="mt-2">= ({{$newA}}/{{$divideA}})<sup class="font-s-14">{{$_POST['b']}}</sup></p>
                                    <p class="mt-2">= {{$newA}}<sup class="font-s-14">{{$_POST['b']}}</sup> / {{$divideA}}<sup class="font-s-14">{{$_POST['b']}}</sup></p>
                                    <p class="mt-2"> = {{$detail['ans']}}</p>
                                @elseif (count($floatChkB)==2)
                                    @php
                                        $divideB = pow(10,strlen($floatChkB[1]));
                                        $newB = $_POST['b']*$divideB;
                                    @endphp
                                    <p class="mt-2">= {{$_POST['a']}}<sup class="font-s-14">{{$_POST['b']}}</sup></p>
                                    <p class="mt-2">= {{$_POST['a']}}<sup class="font-s-14">({{$newB}}/{{$divideB}})</sup></p>
                                    <p class="mt-2">= <sup class="font-s-14">{{$divideB}}</sup>√({{$_POST['a']}}<sup class="font-s-14">{{$newB}}</sup>)</p>
                                    <p class="mt-2"> = {{$detail['ans']}}</p>
                                @else
                                    <p class="mt-2">= {{$_POST['a']}}<sup class="font-s-14">{{$_POST['b']}}</sup> = {{$detail['ans']}}</p>
                                @endif
                            @else
                                <p class="mt-2">{!!$detail['res']!!}</p>
                            @endif
                            @isset($detail['round_ans'])
                                @php
                                    $round_array = [
                                    '-3' => 'Thousands',
                                    '-2' => 'Hundreds',
                                    '-1' => 'Tens',
                                    '0' => 'Ones',
                                    '1' => '1 Decimal',
                                    '2' => '2 Decimal',
                                    '3' => '3 Decimal',
                                    '4' => '4 Decimal',
                                    '5' => '5 Decimal',
                                    '6' => '6 Decimal',
                                ];
                                @endphp
                                <p class="mt-2">Rounding to {{$round_array[$_POST['rounding']]}} Place</p>
                                <p class="mt-2">= {{$detail['round_ans']}}</strong></p>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('method').addEventListener('change', function() {
                if(this.value === '2'){
                    document.getElementById('changeText').textContent = "a - b = ?";
                }else if (this.value === '3'){
                    document.getElementById('changeText').textContent = "a x b = ?";
                }else if (this.value === '4'){
                    document.getElementById('changeText').textContent = "a ÷ b = ?";
                }else if (this.value === '5'){
                    document.getElementById('changeText').innerHTML = "a<sup class='font-s-14'>b</sup> = ?";
                }else if (this.value === '6'){
                    document.getElementById('changeText').innerHTML = "<sup class='font-s-14'>a</sup>√b = ?";
                }else if (this.value === '7'){
                    document.getElementById('changeText').innerHTML = "log<sub class='font-s-14'>a</sub>b = ?";
                }else{
                    document.getElementById('changeText').textContent = "a + b = ?";
                }
            });
        </script>
    @endpush
</form>
