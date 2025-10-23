<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php
                if (!isset($detail)) {
                    $_POST['round'] = "8";
                }
            @endphp
            <p class="col-span-12 label"><strong>{{$lang['13']}}</strong> {{$lang['14']}}</p>
            <div class="col-span-12 flex items-center">
                <div>
                    <input type="text" name="a" id="a" class="input mb-2" value="{{ isset($_POST['a'])?$_POST['a']:'5' }}" aria-label="input"/>
                    <hr>
                    <input type="text" name="b" id="b" class="input mt-2" value="{{ isset($_POST['b'])?$_POST['b']:'8' }}" aria-label="input"/>
                </div>
                <div class="mx-3 font-s-32"><strong>=</strong></div>
                <div>
                    <input type="text" name="c" id="c" class="input mb-2" value="{{ isset($_POST['c'])?$_POST['c']:'x' }}" aria-label="input"/>
                    <hr>
                    <input type="text" name="d" id="d" class="input mt-2" value="{{ isset($_POST['d'])?$_POST['d']:'24' }}" aria-label="input"/>
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
                        <div class="row">
                            @php
                                $a = $_POST['a'];
                                $b = $_POST['b'];
                                $c = $_POST['c'];
                                $d = $_POST['d'];
                            @endphp
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    @if(isset($detail['a_val']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $a }}</strong></td>
                                            <td class="py-2 border-b">{{$detail['a_val']}}</td>
                                        </tr>
                                    @elseif(isset($detail['b_val']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $b }}</strong></td>
                                            <td class="py-2 border-b">{{$detail['b_val']}}</td>
                                        </tr>
                                    @elseif(isset($detail['c_val']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $c }}</strong></td>
                                            <td class="py-2 border-b">{{$detail['c_val']}}</td>
                                        </tr>
                                    @elseif(isset($detail['d_val']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $d }}</strong></td>
                                            <td class="py-2 border-b">{{$detail['d_val']}}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['5']}}:</strong></p>
                                <p class="mt-2">{{$lang['6']}}</p>
                                <p class="mt-2">{{$lang['7']}}</p>
                                @if(isset($detail['a_val']))
                                    <p class="mt-2">\( { {{$a}}\over {{$b}}} = { {{$c}}\over {{$d}}} \)</p>
                                    <p class="mt-2">{{$lang['8']}}</p>
                                    <p class="mt-2">\( {{$a}}\times {{$d}} = {{$b}}\times {{$c}} \)</p>
                                    <p class="mt-2">{{$lang['9']}} {{$a}}</p>
                                    <p class="mt-2">\( {{$a}} = { {{$b}}\times {{$c}} \over {{$d}}} \)</p>
                                    <p class="mt-2">\( {{$a}} = {{$detail['a_val']}} \)</p>
                                    <p class="mt-2">{{$lang['10']}}</p>
                                    <p class="mt-2">{{$lang['11']}}</p>
                                    @if($b>$d)
                                        @php $s1=$b/$d; @endphp
                                        <p class="mt-2">if<br>{{$b}} ÷ {{$d}} = {{$s1}}</p>
                                        <p class="mt-2">{{$lang['12']}}<br>{{$a}} ÷ {{$c}} = {{$s1}}</p>
                                        <p class="mt-2">{{$lang['9']}} {{$a}}</p>
                                        <p class="mt-2">{{$a}} = {{$c}} x {{$s1}}</p>
                                    @else
                                        @php $s1=$d/$b; @endphp
                                        <p class="mt-2">if<br>{{$d}} ÷ {{$b}} = {{$s1}}</p>
                                        <p class="mt-2">{{$lang['12']}}<br>{{$c}} ÷ {{$a}} = {{$s1}}</p>
                                        <p class="mt-2">{{$lang['9']}} {{$a}}</p>
                                        <p class="mt-2">{{$a}} = {{$c}} ÷ {{$s1}}</p>
                                    @endif
                                    <p class="mt-2">{{$a}} = {{$detail['a_val']}}</p>
                                @elseif(isset($detail['b_val']))
                                    <p class="mt-2">\( { {{$a}}\over {{$b}}} = { {{$c}}\over {{$d}}} \)</p>
                                    <p class="mt-2">{{$lang['8']}}</p>
                                    <p class="mt-2">\( {{$a}}\times {{$d}} = {{$b}}\times {{$c}} \)</p>
                                    <p class="mt-2">{{$lang['9']}} {{$b}}</p>
                                    <p class="mt-2">\( {{$b}} = { {{$a}}\times {{$d}} \over {{$c}}} \)</p>
                                    <p class="mt-2">\( {{$b}} = {{$detail['b_val']}} \)</p>
                                    <p class="mt-2">{{$lang['10']}}</p>
                                    <p class="mt-2">{{$lang['11']}}</p>
                                    @if($a>$c)
                                        @php $s2=$a/$c; @endphp
                                        <p class="mt-2">if</p>
                                        <p class="mt-2">{{$a}} ÷ {{$c}} = {{$s2}}</p>
                                        <p class="mt-2">{{$lang['12']}}</p>
                                        <p class="mt-2">{{$b}} ÷ {{$d}} = {{$s2}}</p>
                                        <p class="mt-2">{{$lang['9']}} {{$b}}</p>
                                        <p class="mt-2">{{$b}} = {{$d}} x {{$s2}}</p>
                                    @else
                                        @php $s2=$c/$a; @endphp
                                        <p class="mt-2">if</p>
                                        <p class="mt-2">{{$c}} ÷ {{$a}} = {{$s2}}</p>
                                        <p class="mt-2">{{$lang['12']}}</p>
                                        <p class="mt-2">{{$d}} ÷ {{$b}} = {{$s2}}</p>
                                        <p class="mt-2">{{$lang['9']}} {{$b}}</p>
                                        <p class="mt-2">{{$b}} = {{$d}} ÷ {{$s2}}</p>
                                    @endif
                                    <p class="mt-2"><?=$b?> = <?=$detail['b_val']?></p>
                                @elseif(isset($detail['c_val']))
                                    <p class="mt-2">\( { {{$a}}\over {{$b}}} = { {{$c}}\over {{$d}}} \)</p>
                                    <p class="mt-2">{{$lang['8']}}</p>
                                    <p class="mt-2">\( {{$a}}\times {{$d}} = {{$b}}\times {{$c}} \)</p>
                                    <p class="mt-2">{{$lang['9']}} {{$c}}</p>
                                    <p class="mt-2">\( {{$c}} = { {{$a}}\times {{$d}} \over {{$b}}} \)</p>
                                    <p class="mt-2">\( {{$c}} = {{$detail['c_val']}} \)</p>
                                    <p class="mt-2">{{$lang['10']}}</p>
                                    <p class="mt-2">{{$lang['11']}}</p>
                                    @if($d>$b)
                                        @php $s3=$d/$b; @endphp
                                        <p class="mt-2">if</p>
                                        <p class="mt-2">{{$d}} ÷ {{$b}} = {{$s3}}</p>
                                        <p class="mt-2">{{$lang['12']}}</p>
                                        <p class="mt-2">{{$c}} ÷ {{$a}} = {{$s3}}</p>
                                        <p class="mt-2">{{$lang['9']}} {{$c}}</p>
                                        <p class="mt-2">{{$c}} = {{$a}} x {{$s3}}</p>
                                    @else
                                        @php $s3=$b/$d; @endphp
                                        <p class="mt-2">if</p>
                                        <p class="mt-2">{{$b}} ÷ {{$d}} = {{$s3}}</p>
                                        <p class="mt-2">{{$lang['12']}}</p>
                                        <p class="mt-2">{{$a}} ÷ {{$c}} = {{$s3}}</p>
                                        <p class="mt-2">{{$lang['9']}} {{$c}}</p>
                                        <p class="mt-2">{{$c}} = {{$a}} ÷ {{$s3}}</p>
                                    @endif
                                    <p class="mt-2">{{$c}} = {{$detail['c_val']}}</p>
                                @elseif(isset($detail['d_val']))
                                    <p class="mt-2">\( { {{$a}}\over {{$b}}} = { {{$c}}\over {{$d}}} \)</p>
                                    <p class="mt-2">{{$lang['8']}}</p>
                                    <p class="mt-2">\( {{$a}}\times {{$d}} = {{$b}}\times {{$c}} \)</p>
                                    <p class="mt-2">{{$lang['9']}} {{$c}}</p>
                                    <p class="mt-2">\( {{$d}} = { {{$b}}\times {{$c}} \over {{$a}}} \)</p>
                                    <p class="mt-2">\( {{$d}} = {{$detail['d_val']}} \)</p>
                                    <p class="mt-2">{{$lang['10']}}</p>
                                    <p class="mt-2">{{$lang['11']}}</p>
                                    @if($c>$a)
                                        @php $s4=$c/$a; @endphp
                                        <p class="mt-2">if<br>{{$c}} ÷ {{$a}} = {{$s4}}</p>
                                        <p class="mt-2">{{$lang['12']}}<br>{{$d}} ÷ {{$b}} = {{$s4}}</p>
                                        <p class="mt-2">{{$lang['9']}} {{$c}}</p>
                                        <p class="mt-2">{{$d}} = {{$b}} x {{$s4}}</p>
                                    @else
                                        @php $s4=$a/$c; @endphp
                                        <p class="mt-2">if</p>
                                        <p class="mt-2">{{$a}} ÷ {{$c}} = {{$s4}}</p>
                                        <p class="mt-2">{{$lang['12']}}</p>
                                        <p class="mt-2">{{$b}} ÷ {{$d}} = {{$s4}}</p>
                                        <p class="mt-2">{{$lang['9']}} {{$c}}</p>
                                        <p class="mt-2">{{$d}} = {{$b}} ÷ {{$s4}}</p>
                                    @endif
                                    <p class="mt-2">{{$d}} = {{$detail['d_val']}}</p>
                                @endif 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
    @endpush
</form>