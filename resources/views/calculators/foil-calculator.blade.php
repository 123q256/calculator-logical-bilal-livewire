<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                
            <div class="col-span-12">
                <label for="exp" class="font-s-14 text-blue" id="heading2">{{ $lang[1] }}</label>
                <div class="w-full py-2">
                    <input type="text" name="exp" id="exp" class="input" value="{{ isset($_POST['exp']) ? $_POST['exp'] : '(2x+1)(5x-7)' }}" aria-label="input" />
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
                                $eq=$detail['eq'];
                                $ans=$detail['ans'];
                                $a=$detail['a'];
                                $b=$detail['b'];
                                $s1=$detail['s1'];
                                $s2=$detail['s2'];
                                $s3=$detail['s3'];
                                $s4=$detail['s4'];
                                $opr=$detail['opr'];
                            @endphp
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang['3'] }}</strong></td>
                                        <td class="py-2 border-b">\( {{$ans}} \)</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['4']}}:</strong></p>
                                <p class="mt-2">{{$lang['2']}}</p>
                                <p class="mt-2">\( {{$eq}} \)</p>
                                @if(isset($detail['exp']) && $detail['exp']==2)
                                    <p class="mt-2">\( {{$eq}} = ({{$detail['equ']}})({{$detail['equ']}}) \)</p>
                                    <p class="mt-2">\( ({{$detail['equ']}})({{$detail['equ']}}) = ({{$a}})({{$a}}) + ({{$a}})({{$b}}) + ({{$b}})({{$a}}) + ({{$b}})({{$b}}) \)</p>
                                    <p class="mt-2">\( ({{$detail['equ']}})({{$detail['equ']}}) = {{$s1}} {{(preg_match('/\-/',$s2))?$s2:'+'.$s2}} {{(preg_match('/\-/',$s3))?$s3:'+'.$s3}} {{(preg_match('/\-/',$s4))?$s4:'+'.$s4}} \)</p>
                                    <p class="mt-2">\( ({{$detail['equ']}})({{$detail['equ']}}) = {{$ans}} \)</p>
                                @elseif(isset($detail['check']))
                                    <p class="mt-2">\( {{$detail['eq']}} = ({{$a}})({{$detail['c']}}) + ({{$a}})({{$detail['d']}}) + ({{$b}})({{$detail['c']}}) + ({{$b}})({{$detail['d']}}) \)</p>
                                    <p class="mt-2">\( {{$detail['eq']}} = {{$s1}} {{(preg_match('/\-/',$s2))?$s2:'+'.$s2}} {{(preg_match('/\-/',$s3))?$s3:'+'.$s3}} {{(preg_match('/\-/',$s4))?$s4:'+'.$s4}} \)</p>
                                    <p class="mt-2">\( {{$detail['eq']}} = {{$ans}} \)</p>
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