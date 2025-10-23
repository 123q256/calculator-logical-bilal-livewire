<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[20%] md:w-[20%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <input type="number" step="any" name="uper" id="uper" class="input mb-2" value="{{ isset($_POST['uper'])?$_POST['uper']:'7' }}" aria-label="input"/>
                <hr>
                <input type="number" step="any" name="btm" id="btm" class="input mt-2" value="{{ isset($_POST['btm'])?$_POST['btm']:'3' }}" aria-label="input"/>
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
                        <div class="col-12 text-[16px]">
                            <p class="mt-2  text-[18px]">
                                @if(isset($detail['rem']))
                                    @if($detail['rem']!=0)
                                        \( 
                                            {{$detail['q']}} \dfrac{ {{$detail['rem']}} }{ {{$_POST['btm']}} }
                                        \)
                                    @else
                                        \( 
                                            {{$detail['q']}}
                                        \)    
                                    @endif
                                @else
                                    \( 
                                        \dfrac{ {{$_POST['uper']}} }{ {{$_POST['btm']}} }
                                    \)    
                                @endif
                            </p>                    
                            <p class="mt-2"><strong>{{$lang['2']}}:</strong></p>
                            @if(isset($detail['rem']))
                                <p class="mt-2">{{$lang['3']}}</p>
                                <p class="mt-2">{{$lang['4']}} ÷ {{$lang['5']}} = {{$lang['6']}} <b>R</b> {{$lang['7']}}</p>
                                <p class="mt-2">{{$_POST['uper']}} ÷ {{$_POST['btm']}} = {{$detail['q']}} <b>R</b> {{$detail['rem']}}</p>
                                <p class="mt-2">
                                    {{$lang['8']}} 
                                    @if($detail['rem']==0)
                                        {{$lang['9']}}
                                    @endif
                                </p>
                                @if($detail['rem']!=0)
                                    <p class="mt-2">\( = \text{ {{$lang['6']}} } \dfrac{\text{ {{$lang['7']}} }}{\text{ {{$lang['10']}}  }} \)</p>
                                    <p class="mt-2">\( \dfrac{{{$_POST['uper']}}}{{{$_POST['btm']}}} = {{$detail['q']}} \dfrac{{{$detail['rem']}}}{{{$_POST['btm']}}} \)</p>
                                @else
                                    <p class="mt-2">\( \dfrac{{{$_POST['uper']}}}{{{$_POST['btm']}}} = {{$detail['q']}} \)</p>
                                @endif
                            @else
                                <p class="mt-2">{{$lang['11']}}</p>
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