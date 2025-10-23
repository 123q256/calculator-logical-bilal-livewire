<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="number" class="label">{{$lang['enter']}}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="number" id="number" class="input" value="{{ isset($_POST['number'])?$_POST['number']:'32131.645' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="per" class="label">{{ $lang['per'] }}:</label>
                    <div class="w-full py-2">
                        <select name="per" id="per" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [
                                    $lang['1']."(-6)",
                                    $lang['2']."(-5)",
                                    $lang['3']."(-4)",
                                    $lang['4']."(-3)",
                                    $lang['5']."(-2)",
                                    $lang['6']."(-1)",
                                    $lang['7']."(0)",
                                    $lang['8']."(+1)",
                                    $lang['9']."(+2)",
                                    $lang['10']."(+3)",
                                    $lang['11']."(+4)",
                                    $lang['12']."(+5)",
                                    $lang['13']."(+6)",
                                    $lang['14']."(+7)",
                                    $lang['15']."(+8)",
                                    $lang['16']."(+9)",
                                    $lang['17']."(+10)",
                                    $lang['18']."(+11)",
                                    $lang['19']."(+12)",
                                    $lang['20']."(+13)",
                                    $lang['21']."(+14)",
                                    $lang['22']."(+15)",
                                    $lang['23']."(+16)",
                                    $lang['24']."(+17)"
                                ];
                                $val =  ["-6",
                                    "-5",
                                    "-4",
                                    "-3",
                                    "-2",
                                    "-1",
                                    "0",
                                    "1",
                                    "2",
                                    "3",
                                    "4",
                                    "5",
                                    "6",
                                    "7",
                                    "8",
                                    "9",
                                    "10",
                                    "11",
                                    "12",
                                    "13",
                                    "14",
                                    "15",
                                    "16",
                                    "17",
                                ];
                                optionsList($val,$name,isset($_POST['per'])?$_POST['per']:"0");
                            @endphp
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
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['ans']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['ans']}}</td>
                                    </tr>
                                    @if($_POST['per'] != 0)
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>Rounded to Nearest Whole Number</strong></td>
                                            <td class="py-2 border-b">{{$detail['one']}}</td>
                                        </tr>
                                    @endif
                                    @if($_POST['per'] != -1)
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>Rounded to Nearest Tenth</strong></td>
                                            <td class="py-2 border-b">{{$detail['two']}}</td>
                                        </tr>
                                    @endif
                                    @if($_POST['per'] != -2)
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>Rounded to Nearest Hundredth</strong></td>
                                            <td class="py-2 border-b">{{$detail['three']}}</td>
                                        </tr>
                                    @endif
                                    @if($_POST['per'] != -3)
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>Rounded to Nearest Thousandth</strong></td>
                                            <td class="py-2 border-b">{{$detail['four']}}</td>
                                        </tr>    
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>