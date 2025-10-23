<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <p class="col-span-12 text-center my-3  text-[20px]"><strong>Ax² + Bx + C</strong></p>
            <div class="col-span-4">
                <label for="A" class="font-s-14 text-blue">A</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="A" id="A" class="input" value="{{ isset($_POST['A']) ? $_POST['A'] : '7' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-4">
                <label for="B" class="font-s-14 text-blue">B</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="B" id="B" class="input" value="{{ isset($_POST['B']) ? $_POST['B'] : '-10' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-4">
                <label for="C" class="font-s-14 text-blue">C</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="C" id="C" class="input" value="{{ isset($_POST['C']) ? $_POST['C'] : '13' }}" aria-label="input" />
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
                                <table class="w-ful text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>Δ =</strong></td>
                                        <td class="py-2 border-b">{{ $detail['sd'] }}</td>
                                    </tr>    
                                </table>
                            </div>
                            @if($detail['sd'] != "0")
                                <p class="mt-2">{{$lang[2]}} Δ ≠ 0, {{$lang[3]}}{{$lang[4]}}{{$lang[5]}}.</p>
                            @else
                                <p class="mt-2">{{$lang[2]}} Δ = 0, {{$lang[3]}} {{$lang[6]}}!</p>
                            @endif
                            <div class="w-full text-[18px]">
                                @php $a=$_POST['A']; $b=$_POST['B']; $c=$_POST['C']; @endphp
                                <p class="mt-2">{{ $lang[7] }} : {{ $a }}x² {{ ($b < 0) ? '- ' : '+ ' }}{{ abs($b) }}x {{ ($c < 0) ? '- ' : '+ ' }}{{ abs($c) }} = 0</p>
                                <p class="mt-2"> {{$lang[8]}} Δ = b² - 4ac</p>
                                <p class="mt-2">a={{$a}}, b= {{$b}}, c= {{$c}}</p>
                                <p class="mt-2">{{$lang['put']}}</p>
                                <p class="mt-2">Δ = ({{$b}})<sup class="font-s-14">2</sup> - 4 x {{$a}} x {{$c}}</p>
                                <p class="mt-2">Δ = {{pow($b,2)}}-{{4*$a*$c}}</p>
                                <p class="mt-2">Δ = {{$detail['sd']}}</p>
                                @if($detail['sd'] != "0")
                                    <p class="mt-2">{{$lang[2]}} Δ ≠ 0,{{$lang[3]}}{{$lang[4]}}{{$lang[5]}}.</p>
                                @else
                                    <p class="mt-2">{{$lang[2]}} Δ = 0, {{$lang[3]}} {{$lang[6]}}!</p>
                                    <p class="mt-2">{{$lang[9]}} p²x² + 2pqx + q² = (px + q)², {{$lang[10]}}</p>
                                    @php
                                        $first=sqrt($a);
                                        $second=sqrt($c);
                                        $z=[];
                                        $z=explode(".", $first);
                                        if (count($z)=="1") {
                                            $first=$first;
                                        }else if (count($z)=="2") {
                                            $first=$a;
                                        }
                                        $y=[];
                                        $y=explode(".", $second);
                                        if (count($y)=="1") {
                                            $second=$second;
                                        }else if (count($y)=="2") {
                                            $second=$c;
                                        }
                                    @endphp
                                    @if(count($z)=="1" && count($y)=="1")
                                        <p class="mt-2">{{ $a }}x² {{ ($b < 0) ? '- ' : '+ ' }}{{ abs($b) }}x {{ ($c < 0) ? '- ' : '+ ' }}{{ abs($c) }} = ({{ $first }}x {{ ($b < 0) ? '- ' : '+ ' }}{{ abs($second) }})²</p>
                                    @elseif(count($z)=="2" && count($y)=="2")
                                        <p class="mt-2">{{ $a }}x² {{ ($b < 0) ? '- ' : '+ ' }}{{ abs($b) }}x {{ ($c < 0) ? '- ' : '+ ' }}{{ abs($c) }} = (√{{ $a }} x {{ ($b < 0) ? '- ' : '+ ' }}√{{ abs($second) }})<sup class="font-s-14">2</sup></p>
                                    @elseif(count($z)=="1" && count($y)=="2")
                                        <p class="mt-2">{{ $a }}x² {{ ($b < 0) ? '- ' : '+ ' }}{{ abs($b) }}x {{ ($c < 0) ? '- ' : '+ ' }}{{ abs($c) }} = ({{ $first }}x {{ ($b < 0) ? '- ' : '+ ' }}√{{ abs($second) }})<sup class="font-s-14">2</sup></p>
                                    @else
                                        <p class="mt-2">{{ $a }}x² {{ ($b < 0) ? '- ' : '+ ' }}{{ abs($b) }}x {{ ($c < 0) ? '- ' : '+ ' }}{{ abs($c) }} = (√{{ $a }} x {{ ($b < 0) ? '- ' : '+ ' }}{{ abs($second) }})<sup class="font-s-14">2</sup></p>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
